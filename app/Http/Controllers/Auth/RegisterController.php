<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Model\Category;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { 
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'p_iva' => ['required', 'numeric'],
            'phone_number' => ['required', 'numeric'],
            'shipment_price' => ['numeric', 'min:0.00', 'nullable'],
            'categories' => ['required', 'min:1'],
            'image' => ['image', 'nullable'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $slug = Str::slug($data['name'], '-');

        $oldUser = User::where('slug', $slug)->first();

        if (!$oldUser) {
            $newSlug = $slug;
        } else {
            $counter = 0;
            while ($oldUser) {
                $newSlug = $slug . '-' . $counter;
                $oldUser = User::where('slug', $newSlug)->first();
                $counter++;
            }
        }

        if (!empty($data['image'])) {
            $img_path = Storage::put('uploads', $data['image']);
            $data['image'] = $img_path;
        } else {
            $data['image'] = null;
        }
        
        $user = User::create([
            'name' => $data['name'],
            'slug' => $newSlug,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'p_iva' => $data['p_iva'],
            'phone_number' => $data['phone_number'],
            'shipment_price' => $data['shipment_price'],
            'image' => $data['image'],
        ]);

        if (!empty($data['categories'])) {
            $user->categories()->attach($data['categories']);
        }

        // $user->save();
        return $user;
    }

    protected function showRegistrationForm()
    {
        $categories = Category::all();
        return view('auth.register', ['categories' => $categories]);
    }
}
