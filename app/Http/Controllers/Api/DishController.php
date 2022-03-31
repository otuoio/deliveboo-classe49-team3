<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Dish;
use App\User;

class DishController extends Controller
{
    public function index($id)
    {
        $user = User::find($id);
        $dishes = Dish::where('user_id', $user->id)->get();

        return response()->json([
            'response' => true,
            'results' => [
                'data' => $dishes,
            ]
        ]);
    }
}
