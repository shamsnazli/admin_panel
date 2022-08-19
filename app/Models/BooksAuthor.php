<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BooksAuthor extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function author(){
        return $this->belongsTo('App\Models\Author', 'author_id');
    }
}
