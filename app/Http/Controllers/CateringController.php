<?php

namespace App\Http\Controllers;

use App\Models\Catering;
use App\Models\MenuItem;
use App\Models\CateringItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CateringController extends Controller
{
    public function create()
    {
        $menuItems = MenuItem::where('available', true)->get();
        return view('pages.catering', compact('menuItems'));
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
            'items' => 'required|array|min:1',
            'items.*.id' => 'required|exists:menu_items,id',
            'items.*.qty' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $catering = Catering::create($validated);

            foreach ($request->items as $itemData) {
                $menuItem = MenuItem::find($itemData['id']);
                CateringItem::create([
                    'catering_id' => $catering->id,
                    'menu_item_id' => $menuItem->id,
                    'name' => $menuItem->name,
                    'price' => $menuItem->price,
                    'qty' => $itemData['qty'],
                ]);
            }

            DB::commit();

            return redirect()->route('catering.create')
                ->with('success', 'Pesanan Catering berhasil! Kami akan segera mengkonfirmasi.')
                ->with('catering', $catering);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal menyimpan pesanan: ' . $e->getMessage()]);
        }
    }
}
