<?php

namespace App\Http\Controllers\Admin;

use App\Phone;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        $phones_quantity = Phone::sum('quantity');
        $total_earning = Order::where('order_status', 1)->sum('total_price');
        $pending_orders = Order::where('order_status', 0)->get();
        return view('admin.dashboard', compact('users', 'phones_quantity', 'total_earning', 'pending_orders'));
    }

}
