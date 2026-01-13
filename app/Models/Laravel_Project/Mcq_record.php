<?php

namespace App\Models\Laravel_Project;

use Illuminate\Database\Eloquent\Model;

class Mcq_record extends Model
{
    function scopeWithMcq($query){
        return $query->join('mcqs', 'mcq_records.mcq_id', '=', 'mcqs.id')->select('mcqs.question', 'mcq_records.*');
    }
}