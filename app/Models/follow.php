<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class follow extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'writter_id',
        'reader_id'
    ];

    public function writter()
    {
        return $this->belongsTo(writter::class);
    }

    public function reader()
    {
        return $this->belongsTo(reader::class);
    }
}
