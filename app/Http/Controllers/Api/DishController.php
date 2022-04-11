<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Dish;
use App\User;

class DishController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();

        $dishes = Dish::select('dishes.*')->join('users', 'users.id','=', 'dishes.user_id')->where('users.slug', $data['slug'])->get();

        return response()->json([
            'response' => true,
            'results' => [
                'data' => $dishes,
            ]
        ]);
    }
}
