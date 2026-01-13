<?php

namespace App\Models\Laravel_Project;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    function quizzes(){
        return $this->hasMany(Quiz::class);
    }

    // function quizzes(){
    //     return $this->hasMany('App\Models\Quiz');
    // }


    // ONE TO ONE RELATIONSHIP
    // function data(){
    //     return $this->hasOne('App\Models\Quiz', 'owner_id');
    // }

    // ONE TO MANY RELATIONSHIP
    // function data(){
    //     return $this->hasMany(Quiz::class, 'owner_id');
    // }

    // MANY TO ONE RELATIONSHIP
    // function seller(){
    //     return $this->belongsTo(Quiz::class);
    // }
}
