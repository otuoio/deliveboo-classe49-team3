<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Dish;
use App\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dish_order.dish_id', '=', 'dishes.id')
            ->where('user_id', Auth::user()->id)->orderBy('orders.updated_at', 'desc')->paginate(20);
        // where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(20);
        $data=[
            'orders' => $orders,
            'name' => 'Tutti gli ordini'
        ];
        return view('admin.orders.index', $data);
    }
}
