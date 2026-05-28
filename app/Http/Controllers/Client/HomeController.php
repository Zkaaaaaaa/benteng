<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\RamesSetting;
use App\Models\SiteSetting;
use App\Models\SiteSettingNL;
use App\Support\RamesMenu;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function indexNL()
    {
        $categories = Cache::remember('client.menu.categories.nl', now()->addMinutes(5), function () {
            return Category::query()
                ->with(['products' => fn ($q) => $q->active()->ordered()])
                ->ordered()
                ->get();
        });

        $ramesMenu = RamesMenu::forHomepage();
        $homeCategories = $categories->where('show_on_home', true);
        $ramesSetting = RamesSetting::query()->first(['*']);
        $site = SiteSettingNL::query()->first(['*']);

        return view('client.index-nl', compact('categories', 'homeCategories', 'site', 'ramesMenu', 'ramesSetting'));
    }

    public function index()
    {
        $categories = Cache::remember('client.menu.categories.en', now()->addMinutes(5), function () {
            return Category::query()
                ->with(['products' => fn ($q) => $q->active()->ordered()])
                ->ordered()
                ->get();
        });

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
}
