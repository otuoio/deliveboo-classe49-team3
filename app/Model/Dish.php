<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Dish extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'image',
        'description',
        'slug',
        'price',
        'visible',
        'vegan',
        'spicy',
        'user_id',
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

    public function createSlug($name)
    {
        $slug = Str::slug($name, '-');

        $oldDish = Dish::where('slug', $slug)->first();

        $counter = 0;
        while ($oldDish) {
            $newSlug = $slug . '-' . $counter;
            $oldDish = Dish::where('slug', $newSlug)->first();
            $counter++;
        }

        return (empty($newSlug)) ? $slug : $newSlug;
    }
    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Model\Order')->withPivot('qty')->withTimestamps();
    }
}
