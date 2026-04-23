<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use Illuminate\Http\Request;

class CateringController extends Controller
{
    public function create()
    {
        return view('pages.catering');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'people' => 'required|integer|min:1',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'note' => 'nullable|string|max:500',
        ]);

        $catering = Catering::create($validated);

        return redirect()->route('catering.create')
            ->with('success', 'Pesanan Catering berhasil! Kami akan segera mengkonfirmasi.')
            ->with('catering', $catering);
    }
}
