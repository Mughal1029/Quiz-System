<?php

namespace App\Models\Laravel_Project;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    // MANY TO ONE RELATIONSHIP    
    function category(){
        return $this->belongTo(Category::class);
    }

    // ONE TO MANY RELATIONSHIP
    function Mcq(){
        return $this->hasMany(Mcq::class);
    }

    // ONE TO MANY RELATIONSHIP
    function records(){
        return $this->hasMany(Record::class);
    }
}
