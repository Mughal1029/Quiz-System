<?php

namespace App\Models\Laravel_Project;

use Illuminate\Database\Eloquent\Model;

class Mcq extends Model
{
    // MANY TO ONE RELATIONSHIP
    function Quiz(){
        return $this->belongsTo(Quiz::class);
    }
}
