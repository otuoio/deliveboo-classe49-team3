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
        $data=[
            'dishes' => $dishes,
            'name' => 'Tutti i piatti'
        ];
        return view('admin.dishes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=[
            'name' => 'Crea nuovo piatto'
        ];
        return view('admin.dishes.create', $data);
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
    public function edit(Dish $dish)
    {
        if (Auth::user()->id != $dish->user_id) {
            abort('403');
        }

        $data = [
            'dish' => $dish,
            'name' => 'Modifica ' . $dish->name,
        ];
        return view('admin.dishes.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        $data = $request->all();
        if (Auth::user()->id != $dish->user_id) {
            abort('403');
        }
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'image' => 'nullable|image',
            'description' => 'nullable',
            'visible' => 'nullable|boolean',
            'vegan' => 'nullable|boolean',
            'spicy' => 'nullable|boolean',
            'price' => 'required|numeric|min:0.01',
        ]);
        if ($data['name'] != $dish->name) {
            $dish->name = $data['name'];
            $dish->slug = $dish->createSlug($data['name']);
        }
        if ($data['description'] != $dish->description) {
            $dish->description = $data['description'];
        }
        if ($data['price'] != $dish->price) {
            $dish->price = $data['price'];
        }
        if ($data['vegan'] != $dish->vegan) {
            $dish->vegan = $data['vegan'];
        }
        if ($data['spicy'] != $dish->spicy) {
            $dish->spicy = $data['spicy'];
        }
        if ($data['visible'] != $dish->visible) {
            $dish->visible = $data['visible'];
        }
        if (!empty($data['image'])) {
            Storage::delete($dish->image);
            $image_path = Storage::put('uploads', $data['image']);
            $dish->image = $image_path;
        }
        
        $dish->update();

        return redirect()->route('admin.dishes.show', $dish);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Dish $dish)
    {
        if (Auth::user()->id != $dish->user_id) {
            abort('403');
        }
        $dish->delete();

        return redirect()->route('admin.dishes.index')->with('status', "$dish->name eliminato");
    }

}
