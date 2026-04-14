<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Get cart data (JSON)
     */
    public function index()
    {
        $cart = session('cart', []);
        $totalItems = collect($cart)->sum('qty');
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return response()->json([
            'cart' => array_values($cart),
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice,
        ]);
    }

    /**
     * Tambah item ke keranjang
     */
    public function add(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id',
        ]);

        $menuItem = MenuItem::findOrFail($request->menu_item_id);
        $cart = session('cart', []);
        $key = 'item_' . $menuItem->id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += 1;
        } else {
            $cart[$key] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'image_url' => $menuItem->image_url,
                'qty' => 1,
            ];
        }

        session(['cart' => $cart]);

        return response()->json([
            'message' => $menuItem->name . ' ditambahkan ke keranjang',
            'cart' => array_values($cart),
            'totalItems' => collect($cart)->sum('qty'),
            'totalPrice' => collect($cart)->sum(fn($item) => $item['price'] * $item['qty']),
        ]);
    }

    /**
     * Update quantity item
     */
    public function update(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|integer',
            'delta' => 'required|integer',
        ]);

        $cart = session('cart', []);
        $key = 'item_' . $request->menu_item_id;

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->delta;
            if ($cart[$key]['qty'] <= 0) {
                unset($cart[$key]);
            }
        }

        session(['cart' => $cart]);

        return response()->json([
            'cart' => array_values($cart),
            'totalItems' => collect($cart)->sum('qty'),
            'totalPrice' => collect($cart)->sum(fn($item) => $item['price'] * $item['qty']),
        ]);
    }

    /**
     * Hapus item dari keranjang
     */
    public function remove(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|integer',
        ]);

        $cart = session('cart', []);
        $key = 'item_' . $request->menu_item_id;
        unset($cart[$key]);
        session(['cart' => $cart]);

        return response()->json([
            'cart' => array_values($cart),
            'totalItems' => collect($cart)->sum('qty'),
            'totalPrice' => collect($cart)->sum(fn($item) => $item['price'] * $item['qty']),
        ]);
    }

    /**
     * Kosongkan keranjang
     */
    public function clear()
    {
        session()->forget('cart');

        return response()->json([
            'cart' => [],
            'totalItems' => 0,
            'totalPrice' => 0,
        ]);
    }
}
