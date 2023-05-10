<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class category extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'name',
        'icon'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function post()
    {
        return $this->hasMany(post::class);
    }
}
