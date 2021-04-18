<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = [];
    use SoftDeletes;
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);

    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function hasTag($tag_id)
    {
        return in_array($tag_id, $this->tags->pluck('id')->toArray());

    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    /*
     * for Search Functionality
     */
    public function scopeSearched($query)
    {
        $search = request()->query('search');
        if (!$search) {
            return $query;
        }
        return $query->where('title', 'like', "%{$search}%");
    }

}
