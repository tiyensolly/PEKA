<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * Kolom yang boleh diisi lewat create() atau update().
     */
    protected $fillable = [
        'title',
        'body',
        'category',
    ];
}