<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

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

    // public function show($id)
    // {
    //     $post = Post::find($id);

    //     return response()->json([
    //         'response' => true,
    //         'count' => $post ? 1 : 0,
    //         'results' => [
    //             'data' => $post
    //         ],
    //     ]);
    // }
}
