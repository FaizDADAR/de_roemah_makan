<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Catering;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('pages.status');
    }

    public function search(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $phone = $request->phone;
        $orders = Order::with('items')
            ->where('phone', $phone)
            ->orderByDesc('created_at')
            ->get();

        $caterings = Catering::where('phone', $phone)
            ->orderByDesc('created_at')
            ->get();

        return view('pages.status', compact('orders', 'caterings', 'phone'));
    }
}
