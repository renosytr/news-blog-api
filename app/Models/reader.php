<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class reader extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'avatar',
        'genre',
        'summary',
        'mobile',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'is_newsletter'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function writter()
    {
        return $this->belongsToMany(writter::class, 'follows', 'reader_id', 'writter_id' );
    }

    public function post()
    {
        return $this->belongsToMany(post::class, 'like_posts', 'reader_id' , 'post_id');
    }

    public function comment()
    {
        return $this->hasMany(comment::class);
    }

    public function like_comment()
    {
        return $this->belongsToMany(comment::class, 'like_comment', 'reader_id', 'comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
