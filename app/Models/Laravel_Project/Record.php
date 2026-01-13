<?php
namespace App\Models\Laravel_Project;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    function scopeWithQuiz($query){
        return $query->join('quizzes', 'records.quiz_id', '=', 'quizzes.id')->select('quizzes.*', 'records.*');
    }

    // MANY TO ONE RELATIONSHIP    
    function quiz(){
        return $this->belongTo(Quiz::class);
    }
}
