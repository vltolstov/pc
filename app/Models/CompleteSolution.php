<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompleteSolution extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'solution_text',
        'solution_image'
    ];

}
