<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\SiteSettingNL;

class HomeController extends Controller
{
    public function indexNL()
    {
        $categories = Category::query()
            ->with(['products' => fn ($q) => $q->active()->ordered()])
            ->ordered()
            ->get();

        $homeCategories = $categories->where('show_on_home', true);

        $site = SiteSettingNL::first();

        return view('client.index-nl', compact('categories', 'homeCategories', 'site'));
    }

    public function index()
    {
        $categories = Category::query()
            ->with(['products' => fn ($q) => $q->active()->ordered()])
            ->ordered()
            ->get();

        $homeCategories = $categories->where('show_on_home', true);

        $site = SiteSetting::first();

        return view('client.index', compact('categories', 'homeCategories', 'site'));
    }

    public function contact()
    {
        return view('client.contact');
    }
}
