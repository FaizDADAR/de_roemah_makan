<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;

class HomeController extends Controller
{
    public function index()
    {
        $recommended = MenuItem::available()->recommended()->take(4)->get();
        $popular = MenuItem::available()->popular()->take(4)->get();

        return view('pages.home', compact('recommended', 'popular'));
    }
}
