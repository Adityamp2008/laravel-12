<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function index()
    {
        try {
            return view('pages.admin.dashboard');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
