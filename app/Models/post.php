<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;
use Cviebrock\EloquentSluggable\Sluggable;

class post extends Model
{
    use HasFactory;
    use Uuid;
    use Sluggable;

    protected $fillable = [
        'uuid',
        'category_id',
        'writter_id',
        'title',
        'post_content',
        'summary',
        'slug',
        'cover',
        'is_featured',
        'tags',
        'deleted_at'
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function writter()
    {
        return $this->belongsTo(writter::class);
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
    }

    public function reader()
    {
        return $this->belongsToMany(reader::class, 'like_posts', 'post_id', 'reader_id' );
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
