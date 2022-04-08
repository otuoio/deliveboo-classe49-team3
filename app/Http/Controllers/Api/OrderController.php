<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Model\Order;
use App\Model\Dish;
use App\User;
use Carbon\Carbon;
use App\Mail\SendNewMail;
use App\Mail\SendNewRestaurantMail;
use Illuminate\Support\Facades\Mail;
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
        $today = $todayIstance->now()->setTimezone('Europe/Rome');
        $arrivalTime = $todayIstance->addMinutes(30);
        $arrivalTimeFormat = $arrivalTime->format('H:i');
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


        $dish = Dish::where('id', $userCart[0]['id'])->first();

        $restaurant = User::where('id', $dish->user_id)->first();
        $arrivalTime = $todayTime;

        $dataCustomer = [
            'orderInfo' => $orderInfo,
            'restaurantName' => $restaurant->name,
            'arrivalTime' => $arrivalTimeFormat,
        ];

        Mail::to($orderInfo['email'])->send(new SendNewMail($dataCustomer));



        Mail::to($restaurant->email)->send(new SendNewRestaurantMail($dataCustomer));

        return response()->json([
            "success" => true,
            "results" => $newOrder,
        ]);
    }

    public function sendValidation(Request $request){
        $orderInfo = $request->params['info'];

        $validator = Validator::make($orderInfo, [
            'customer_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }else{
            return response()->json([
                'success' => true
            ]);
        }
    }
}