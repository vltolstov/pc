<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'page_type_id',
        'parent_id',
    ];

    public function pageType()
    {
        return $this->hasOne(PageType::class);
    }

    public function slug()
    {
        return $this->hasOne(Slug::class);
    }

    public function image()
    {
        return$this->hasOne(Image::class);
    }

    public function seoSet()
    {
        return $this->hasOne(SeoSet::class);
    }

    public function parametrSet()
    {
        return $this->hasOne(ParametrSet::class);
    }

    public function contentSet()
    {
        return$this->hasOne(ContentSet::class);
    }

    public function category()
    {
        return$this->hasOne(Category::class);
    }

}
