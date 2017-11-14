<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Главная страница
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.index', compact('products'));
    }

    /**
     * Контакты
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contacts()
    {
        return view('pages.contacts');
    }
}
