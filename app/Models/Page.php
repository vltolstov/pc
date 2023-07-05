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
        'active',
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
        return $this->hasOne(Image::class);
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
        return $this->hasOne(ContentSet::class);
    }

    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function completeSolution()
    {
        return $this->hasOne(CompleteSolution::class);
    }

    public function advantage()
    {
        return $this->hasOne(Advantage::class);
    }

    public function relatedPage()
    {
        return $this->hasOne(RelatedPage::class);
    }

    public function offer()
    {
        return $this->hasOne(Offer::class);
    }

}
