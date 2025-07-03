<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertise;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard Mgmt.";
        $countAdvertise = Advertise::count();
        $countPage = Page::count();
        $user_id = \Auth::user()->id;
        $breadcrumb = 'Dashboard';

        return view('admin.dashboard', compact('title', 'countAdvertise', 'countPage', 'breadcrumb'));
    }
}
