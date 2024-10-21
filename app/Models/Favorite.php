<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = "favorite";
    protected $fillable = [
        'file_id',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    function files()
    {
        return $this->belongsTo(Uploadfile::class,'file_id');
    }
}
