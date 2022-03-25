<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'slug',
        'address',
        'p_iva',
        'phone_number',
        'shipment_price',
        'minimum_order',
        'image'
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // public function createSlug($name)
    // {
    //     $slug = Str::slug($name, '-');

    //     $oldUser = User::where('slug', $slug)->first();

    //     $counter = 0;
    //     while ($oldUser) {
    //         $newSlug = $slug . '-' . $counter;
    //         $oldUser = User::where('slug', $newSlug)->first();
    //         $counter++;
    //     }

    //     return (empty($newSlug)) ? $slug : $newSlug;
    // }

    public function dishes()
    {
        return $this->hasMany('App\Model\Dish');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model\Category')->withTimestamps();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
