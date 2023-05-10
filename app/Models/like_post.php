<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class like_post extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'post_id',
        'reader_id'
    ];

    public function post()
    {
        return $this->belongsTo(post::class);
    }

    public function reader()
    {
        return $this->belongsTo(reader::class);
    }
}
