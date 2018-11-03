<?php

namespace App\Shop\Products;

use App\Shop\Comments\Comment;
use Illuminate\Database\Eloquent\Model;
use App\Shop\Categories\Category;
use App\Shop\Images\Image;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'status',
        'quantity'
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeAvailable(Builder $query)
    {
        return $query->where('status', true);
    }

    public function scopeBySlug(Builder $query, $slug)
    {
        return $query->where('slug', $slug);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    /**
     * @param string $name
     */
    public function setNameAttribute(string $name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    /**
     * @return string
     */
    public function getFormattedNameAttribute()
    {
        return ucfirst($this->name);
    }

    /**
     * @param string $price
     */
    public function setPriceAttribute(string $price)
    {
        $this->attributes['price'] = bcmul($price, 100);
    }

    /**
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return '$ ' . number_format(($this->price / 100), 2, ',', ' ');
    }

    /**
     * @param string $description
     */
    public function setDescriptionAttribute(string $description)
    {
        $this->attributes['description'] = trim($description);
    }
}
