<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $user = Auth::user();

        // calcolo gioni mancanti alla fine del mese
        $endMonth = Carbon::now()->endOfMonth()->endOfDay();
        $today = Carbon::now()->format("d-m-Y");
        $days = $endMonth->diffInDays($today);

        return view("admin.home", compact("user", "today", "days"));

    }

}
