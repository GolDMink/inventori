<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function DashboardAdmin()
    {
        return view('admin.dashboard');
    }

    public function DashboardPetugas()
    {
        return "Dashboard Petugas";
    }
}
