<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class comment extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'post_id',
        'reader_id',
        'comment_content'
    ];

    public function post()
    {
        return $this->belongsTo(post::class);
    }

    public function reader()
    {
        return $this->belongsTo(reader::class);
    }

    public function like_comment()
    {
        return $this->belongsToMany(comment::class, 'like_comment', 'comment_id' , 'reader_id');
    }
}
