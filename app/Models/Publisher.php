<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publisher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function Books(){
        return $this->hasMany('App\Models\Book');
    }
}
