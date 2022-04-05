<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Dish;
use Carbon\Carbon;
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
        $orderInfo = $request->params['info'];
        $userCart = $request->params['info']['cartDishes'];
        // $dishes = Dish::all();

        $todayIstance = new Carbon();
        $today = $todayIstance->now();
        $todayDate = $today->format('Y-m-d');
        $todayTime = $today->format('H:i:s');
        

        $newOrder = new Order();
        $newOrder->customer_name = $orderInfo['customer_name'];
        $newOrder->phone_number = $orderInfo['phone_number'];
        $newOrder->address = $orderInfo['address'];
        $newOrder->email = $orderInfo['email'];
        $newOrder->total = $orderInfo['cartTotal'];
        $newOrder->date = $todayDate;
        $newOrder->time = $todayTime;
        $newOrder->save();

        foreach ($userCart as $element) {
            $newOrder->dishes()->attach($element['id'], ['qty' => $element['quantity']]);
        }

        return response()->json([
            "success" => true,
            "results" => $newOrder,
        ]);
    }
}
