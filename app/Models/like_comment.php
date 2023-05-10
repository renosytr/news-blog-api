<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class like_comment extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'comment_id',
        'reader_id'
    ];

    public function comment()
    {
        return $this->belongsTo(comment::class);
    }

    public function reader()
    {
        return $this->belongsTo(reader::class);
    }
}
