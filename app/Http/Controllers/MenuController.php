<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = MenuItem::query();

        // Filter kategori
        if ($request->filled('category') && $request->category !== 'semua') {
            $query->where('category', $request->category);
        }

        // Filter pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter ketersediaan
        if ($request->filled('available')) {
            $query->where('available', $request->available === 'true' || $request->available === '1');
        }

        // Filter harga
        if ($request->filled('price')) {
            match ($request->price) {
                'lt10' => $query->where('price', '<', 10000),
                '10to20' => $query->whereBetween('price', [10000, 20000]),
                'gt20' => $query->where('price', '>', 20000),
                default => null,
            };
        }

        $items = $query->orderBy('name')->get();

        $categories = [
            ['id' => 'semua', 'label' => 'Semua Menu', 'emoji' => '🍽️'],
            ['id' => 'Hidangan Utama', 'label' => 'Hidangan Utama', 'emoji' => '🍛'],
            ['id' => 'Kue Kering', 'label' => 'Kue Kering', 'emoji' => '🍪'],
            ['id' => 'Kue Basah', 'label' => 'Kue Basah', 'emoji' => '🧁'],
            ['id' => 'Gorengan', 'label' => 'Gorengan', 'emoji' => '🍟'],
            ['id' => 'Kerupuk', 'label' => 'Kerupuk', 'emoji' => '🥨'],
            ['id' => 'Minuman', 'label' => 'Minuman', 'emoji' => '🥤'],
        ];

        return view('pages.menu', compact('items', 'categories'));
    }
}
