<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = ['name', 'user_id', 'survey'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
