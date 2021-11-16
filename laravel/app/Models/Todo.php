<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'title', 'detail', 'user_id'
    ];

    /**
    *   todo所有userの取得
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
