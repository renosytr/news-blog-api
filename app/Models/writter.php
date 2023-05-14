<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class writter extends Model
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
        'is_featured'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function post()
    {
        return $this->hasMany(post::class,'writters_id','id');
    }

    public function reader()
    {
        return $this->belongsToMany(reader::class, 'follows', 'writter_id', 'reader_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
