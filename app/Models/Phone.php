<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    use SoftDeletes , HasFactory;
    protected $table = 'phones';

    protected $fillable = [
        'guest_id',
        'number',
        'type',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}
