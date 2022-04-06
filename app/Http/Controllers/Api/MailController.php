<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function store (Request $request){
        $orderInfo = $request->params['info'];
        $userCart = $request->params['info']['cartDishes'];

        $validator = Validator::make($orderInfo, [
            'customer_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
        ]);

        return response()->json([
            "success" => true,
            "results" => $newOrder,
        ]);
    }
}
