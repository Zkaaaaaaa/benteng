<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RamesSetting;
use App\Models\SiteSetting;
use App\Models\SiteSettingNL;
use App\Support\RamesMenu;

class HomeController extends Controller
{
    public function indexNL()
    {
        $categories = $this->menuCategories();

        $ramesMenu = RamesMenu::forHomepage();
        $homeCategories = $categories->where('show_on_home', true);
        $ramesSetting = RamesSetting::query()->first(['*']);
        $site = SiteSettingNL::query()->first(['*']);

        return view('client.index-nl', compact('categories', 'homeCategories', 'site', 'ramesMenu', 'ramesSetting'));
    }

    public function index()
    {
        $categories = $this->menuCategories();

        $ramesMenu = RamesMenu::forHomepage();
        $homeCategories = $categories->where('show_on_home', true);
        $ramesSetting = RamesSetting::query()->first(['*']);
        $site = SiteSetting::query()->first(['*']);

        return view('client.index', compact('categories', 'homeCategories', 'site', 'ramesMenu', 'ramesSetting'));
    }

    public function contact()
    {
        return view('client.contact');
    }

    private function menuCategories()
    {
        return Category::query()
            ->with(['products' => fn ($q) => $q->active()->ordered()])
            ->ordered()
            ->get();
    }
}
