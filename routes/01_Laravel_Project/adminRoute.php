<?php
use App\Http\Controllers\Laravel_Project\adminCont;
use App\Http\Controllers\Laravel_Project\UserCont;

// ADMIN ROUTES
Route::view('admin', '01_Laravel_Project.admin-login');
Route::post('login1', [adminCont::class, 'Login']);

Route::middleware('CheckAdminAuth')->group(function(){
    Route::get('dashboard', [adminCont::class, 'dashboard']);
    Route::get('admin-categories', [adminCont::class, 'categories']);
    Route::get('admin-logout', [adminCont::class, 'logout']);
    Route::post('add-category', [adminCont::class, 'addCategory']);
    Route::get('category/delete/{id}', [adminCont::class, 'deleteCategory']);
    Route::get('add-quiz', [adminCont::class, 'addQuiz']);
    Route::post('add-mcq', [adminCont::class, 'addMcqs']);
    Route::get('end-quiz', [adminCont::class, 'endQuiz']);
    Route::get('show-quiz/{id}/{quizName}', [adminCont::class, 'showQuiz']);
    Route::get('quiz-list/{id}/{cat}', [adminCont::class, 'quizlist']);
});


// USER ROUTES
Route::get('us', [UserCont::class, 'welcome']);
Route::get('user-quiz-list/{id}/{category}', [UserCont::class, 'userQuizlist']);

Route::get('user-signup',function(){
    if(!session()->has('user')){
        return view('01_Laravel_Project.user-signup');
    }else{
        return redirect('us');
    }
});
// Route::view('user-signup', '01_Laravel_Project.user-signup');
Route::post('user-signup', [UserCont::class, 'userSignup']);
Route::get('user-login',function(){
    if(!session()->has('user')){
        return view('01_Laravel_Project.user-login');
    }else{
        return redirect('us');
    }
});
// Route::view('user-login', '01_Laravel_Project.user-login');
Route::post('user-login', [UserCont::class, 'userLogin']);
Route::get('start-quiz/{id}/{name}', [UserCont::class, 'startQuiz']);    
// START MCQs ROUTES
Route::get('mcq/{id}/{name}', [UserCont::class, 'mcq']);
    
Route::middleware('CheckUserAuth')->group(function(){
    Route::get('user-logout', [UserCont::class, 'userLogout']);
    Route::post('submit-next/{id}', [UserCont::class, 'submitandNext']);
    Route::get('user-details', [UserCont::class, 'userDetails']);
    Route::get('quiz-search', [UserCont::class, 'quizSearch']);
});

Route::get('verify-user/{email}',[UserCont::class,'verifyUser']);
Route::view('user-forget-password', '01_Laravel_Project.user-forget-password');
Route::post('user-forget-password', [UserCont::class, 'userForgetPassword']);
Route::get('user-forget-password/{email}',[UserCont::class,'userResetPassword']);
Route::post('reset-password',[UserCont::class,'ResetPassword']);
Route::get('categories-list',[UserCont::class, 'categories']);
Route::get('certificate',[UserCont::class, 'Certificate']);
Route::get('download-certificate',[UserCont::class, 'downCertificate']);
































// Route::get('user-signup-quiz', [UserCont::class, 'userSignupQuiz']);
// Route::get('user-login-quiz', [UserCont::class, 'userLoginQuiz']);