<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\SiteSetting;
use App\Models\SiteSettingNL;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with('products')->get();
        $products = Product::with('category')->get();
        $site = SiteSetting::query()->first();

        return view('client.index', compact('categories', 'products', 'site'));
    }

    public function indexNL()
    {
        $categories = Category::with('products')->get();
        $products = Product::with('category')->get();
        $site = SiteSettingNL::query()->first();

        return view('client.index-nl', compact('categories', 'products', 'site'));
    }

    public function contact()
    {
        $site = SiteSetting::query()->first();

        return view('client.contact', compact('site'));
    }
}
