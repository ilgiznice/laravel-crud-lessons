<?php

namespace App\Http\Controllers;

use App\Order;
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
        $products = Product::limit(4)->get();
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

    /**
     * Карточка товара
     *
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showProduct(Product $product)
    {
        return view('pages.showProduct', compact('product'));
    }

    /**
     * Страница заказов
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showOrders()
    {
        return view('pages.showOrders');
    }

 /*   public function showProductAnalog($id)
    {
        $product = Product::find($id);
        return view('pages.showProduct', compact('product'));
    }*/
}
