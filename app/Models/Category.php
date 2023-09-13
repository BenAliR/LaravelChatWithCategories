<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, Sluggable;
    protected $guarded = ['id'];

    public function groups()
    {
        return $this->hasMany(ChatGroup::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function getRouteKeyName(){
        return 'slug';
    }
}
