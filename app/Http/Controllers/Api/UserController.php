<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json([
            'response' => true,
            'results' => [
                'data' => $users,
            ]
        ]);
    }

    public function popular() //chiamata per prendere i dati degli users associati all'ordine
    {
        $populars = User::select('users.id', 'users.name', 'users.email', 'users.password', 'users.slug', 'users.address', 'users.p_iva', 'users.phone_number', 'users.shipment_price', 'users.image', 'orders.id as orderID')
        ->distinct()
            ->join('dishes', 'dishes.user_id', '=', 'users.id')
            ->join('dish_order', 'dishes.id', '=', 'dish_order.dish_id')
            ->join('orders', 'dish_order.order_id', '=', 'orders.id')->get();

        return response()->json([
            'response' => true,
            'results' => [
                'data' => $populars,
            ]
        ]);
    }

    public function show(Request $request)
    {
        $data = $request->all();

        $user = User::where('slug', $data['slug'])->get();

        return response()->json([
            'response' => true,
            'count' => $user ? 1 : 0,
            'results' => [
                'data' => $user
            ],
        ]);
    }

    public function search(Request $request)
    {
        $data = $request->all();

        //apriamo una chiamata eloquent senza chiuderla
        $users = User::where('id', '>=', 1);

        if (array_key_exists('categories', $data)) {

            foreach ($data['categories'] as $category) {
            $users->whereHas('categories', function (Builder $query) use ($category) {
                    $query->where('name', '=', $category);
                });
            }
        }
        
        $users = $users->with(['categories'])->get();

        return response()->json([
            'success' => true,
            'count' =>  $users->count(),
            'results' => [
                'data' => $users
            ]
        ]);
    }
}
