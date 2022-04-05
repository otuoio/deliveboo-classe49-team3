<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;

class OrderController extends Controller
{
    public function orderDatas(){
        $orders = Order::all();
        
        return response()->json([
            "success" => true,
            "results" => $orders,
        ]);
    }
    public function sendOrder(Request $request) {
        $data = $request->params['info'];
        // return view('guest.success', ['data'=>$data]);
        return response()->json([
            "success" => true,
            "results" => $data,
        ]);
    }
}
