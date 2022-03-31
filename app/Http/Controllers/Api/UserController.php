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

    // public function show($id)
    // {
    //     $user = User::find($id);

    //     return response()->json([
    //         'response' => true,
    //         'count' => $user ? 1 : 0,
    //         'results' => [
    //             'data' => $user
    //         ],
    //     ]);
    // }

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

    // SEARCHBAR
    // public function searchName(Request $request)
    // {
    //     $data = $request->all();

    //     //apriamo una chiamata eloquent senza chiuderla
    //     $users = User::where('id', '>=', 1);

    //     if (array_key_exists('inputSearch', $data)) {
    //         $users->where('name','like','%'. $data['inputSearch'].'%');
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'count' =>  $users->count(),
    //         'results' => [
    //             'data' => $users->get()
    //         ]
    //     ]);
    // }
}
