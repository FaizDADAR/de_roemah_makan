<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session('cart', []);
        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        return view('pages.checkout', compact('cart', 'totalPrice'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'note' => 'nullable|string|max:1000',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Keranjang kosong'], 422);
            }
            return back()->with('error', 'Keranjang kosong!');
        }

        $totalPrice = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'phone' => $validated['phone'],
            'note' => $validated['note'] ?? null,
            'total' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            $order->items()->create([
                'menu_item_id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'qty' => $item['qty'],
            ]);
        }

        // Kosongkan keranjang
        session()->forget('cart');

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Pesanan berhasil dicatat',
                'order_id' => str_pad($order->id, 6, '0', STR_PAD_LEFT)
            ]);
        }

        return redirect()->route('checkout.create')
            ->with('success', 'Pesanan berhasil dibuat!')
            ->with('order', $order);
    }
}
