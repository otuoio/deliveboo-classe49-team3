<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Dish;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dishes = Dish::where('user_id', Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(20);

        return view('admin.dishes.index', ['dishes' => $dishes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'visible' => 'nullable|boolean',
            'vegan' => 'nullable|boolean',
            'spicy' => 'nullable|boolean',
            'price' => 'required|numeric|min:0.01',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;

        if (!empty($data['image'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        }else{
            $data['image'] = 'default.png';
        }

        if(isset($data['visible']) && $data['visible'] == 'visible'){
            $data['visible'] = 1;
        }else{
            $data['visible'] = 0;
        }

        $newDish = new Dish();

        $newDish->fill($data);
        $newDish->slug = $newDish->createSlug($data['name']);
        $newDish->save();

        return redirect()->route('admin.dishes.show', $newDish->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        $data = [
            'dish' => $dish,
            'name' => $dish->name,
        ];

        return view('admin.dishes.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
