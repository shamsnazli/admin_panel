<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BooksCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    public function category(){
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
}