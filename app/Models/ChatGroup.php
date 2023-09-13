<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'category_id',
        'link',
        'description',

    ];
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function messages(){
        return $this->hasMany(Message::class,'chat_id')->orderBy('created_at','asc');
    }
    public function members(){
        return $this->hasMany(Member::class,'chat_id');
    }
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
