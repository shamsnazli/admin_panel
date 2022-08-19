<?php

namespace App\Models;

use Dotenv\Repository\Adapter\GuardedWriter;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $fillable = ['id'];
    protected $guarded = [];
    public function publisher(){
        return $this->belongsTo('App\Models\Publisher', 'publisher_id');
    }

    public function books_author(){
        return $this->hasMany('App\Models\BooksAuthor');
    }

    public function books_category(){
        return $this->hasMany('App\Models\BooksCategory');
    }
}
