<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelatedPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'related_page_id',
        'related_page_text',
    ];

}
