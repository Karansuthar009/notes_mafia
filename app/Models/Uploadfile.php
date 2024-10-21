<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadfile extends Model
{
    use HasFactory;

    function subjects()
    {
        return $this->belongsTo(Subject::class,'subject');
    }
    function colleges()
    {
        return $this->belongsTo(CollageData::class,'college');
    }
    function courses()
    {
        return $this->belongsTo(Course::class,'course');
    }

    function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
