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
        $orders = Order::select('orders.id', 'orders.date', 'orders.time', 'orders.customer_name', 'orders.phone_number', 'orders.address', 'orders.email', 'orders.updated_at', 'orders.total')
            ->distinct()
            ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dishes.id', '=', 'dish_order.dish_id')
            ->where('user_id', Auth::user()->id)
            ->orderBy('orders.date', 'desc')
            ->paginate(20);

        $data=[
            'orders' => $orders,
            'name' => 'Tutti gli ordini'
        ];
        return view('admin.orders.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function statistics() //passa alla admin home i dati degli ordini da manipolare per le statistiche
    {
        $ordersData = Order::select('orders.id', 'orders.date', 'orders.time', 'orders.customer_name', 'orders.phone_number', 'orders.address', 'orders.email', 'orders.updated_at', 'orders.total')
        ->distinct()
            ->join('dish_order', 'orders.id', '=', 'dish_order.order_id')
            ->join('dishes', 'dishes.id', '=', 'dish_order.dish_id')
            ->where('user_id', Auth::user()->id)
            ->orderBy('orders.updated_at', 'desc')
            ->paginate(100);


        $data = [
            'ordersData' => $ordersData
        ];
        return view('admin.home', $data);
    }
}
