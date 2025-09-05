<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mews\Purifier\Facades\Purifier;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id','title','slug','short_des','content','image_path','is_published','published_at'
    ];


    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];


    public function setContentAttribute($value)
    {
        // Sanitize incoming HTML
        $clean = Purifier::clean($value, 'blog');
        $this->attributes['content'] = $clean;

        // Auto-short_des if not provided
        if (empty($this->attributes['short_des'])) {
            $this->attributes['short_des'] = Str::limit(strip_tags($clean), 160);
        }
    }


    protected static function booted()
    {
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $base = Str::slug($article->title);
                $slug = $base;
                $i = 1;
                while (static::where('slug',$slug)->exists()) {
                    $slug = $base.'-'.$i++;
                }
                $article->slug = $slug;
            }

            if ($article->is_published && empty($article->published_at)) {
                $article->published_at = now();
            }
        });

         static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if ($article->is_published && empty($article->published_at)) {
                $article->published_at = now();
            }
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
