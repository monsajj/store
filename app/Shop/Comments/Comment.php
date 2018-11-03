<?php

namespace App\Shop\Comments;

use App\Shop\Products\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_name',
        'user_email',
        'text'
    ];

    /**
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeByProduct(Builder $query, $product)
    {
        return $query->where('product', $product);
    }

    /**
     * @param string $user_name
     */
    public function setUserNameAttribute(string $user_name)
    {
        $this->attributes['user_name'] = strtolower($user_name);
    }

    /**
     * @return string
     */
    public function getFormattedNameAttribute()
    {
        return ucfirst($this->name);
    }

    /**
     * @param string $text
     */
    public function setDescriptionAttribute(string $text)
    {
        $this->attributes['text'] = trim($text);
    }
}
