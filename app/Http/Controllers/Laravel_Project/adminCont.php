<?php

namespace App\Http\Controllers\Laravel_Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Laravel_Project\Admin;
use App\Models\Laravel_Project\Category;
use App\Models\Laravel_Project\Quiz;
use App\Models\Laravel_Project\Mcq;
use App\Models\Laravel_Project\User;
class adminCont extends Controller
{
    function Login(Request $req){
        // return "admin login";
        $validation = $req->validate([
            'name'=>'required',
            'password'=>'required'
        ]);
        
        $admin = Admin::where([
            ['name', "=", $req->name],
            ['password', "=", $req->password],
        ])->first();

        if (!$admin) {
             return back()->withErrors(['name'=>'Admin does not exist']);
        }
            Session::put('admin', $admin);
            return redirect('dashboard');
        }

        function dashboard(){
            $admin=Session::get('admin');
            if ($admin) {
               $usersList=User::orderBy('id','desc')->paginate(5);
                return view('01_Laravel_Project.admin', ["name"=>$admin->name, "users"=>$usersList]);
            }else {
            return redirect('admin');
            }
        }

        function categories(){
            $categories=Category::get();
            $admin=Session::get('admin');
            if ($admin) {
                return view('01_Laravel_Project.categories', ["name"=>$admin->name, "categories"=>$categories]);
            }else {
                return redirect('admin');
            }
        }

        function logout(){
            Session::forget('admin');
            return redirect('admin');
        }

        function addCategory(Request $requ){
            $validate=$requ->validate([
                "category"=>"required | min:3 | unique:categories,name"
            ]);
            $admin= Session::get('admin');
            $categ= new Category();
            $categ->name=$requ->category;
            $categ->creator=$admin->name;
            if ($categ->save()) {
               Session::flash('category', "Category " .$requ->category . " Added") ;
            }
            return redirect('admin-categories');
}

        function deleteCategory($id){
            $isDeleted=Category::find($id)->delete();
            if ($isDeleted) {
                Session::flash('category', "Success: Category deleted");
                return redirect("admin-categories");
            }
        }

        function addQuiz(){
            $admin=Session::get('admin');
            $categories= Category::get();
            $totalMCQs=0;
            if ($admin) {
                $quizName=request('quiz');
                $category_id=request('category_id');

                if ($quizName && $category_id && !Session::has('quizDetails')) {
                    $quiz=new Quiz();
                    $quiz->name=$quizName;
                    $quiz->category_id=$category_id;
                    if ($quiz->save()) {
                        Session::put('quizDetails', $quiz);
                    }
                }else{
                    $quiz= Session::get('quizDetails');
                    if ($quiz) {
                        $totalMCQs= $quiz && Mcq::where('quiz_id', $quiz->id)->count();
                    }else{
                        $totalMCQs= 0;
                    }
                }

                return view('01_Laravel_Project\add-quiz', ["name"=>$admin->name, "categories"=>$categories, "totalMCQs"=>$totalMCQs]);
            }else{
                return redirect('admin-login');
            }
        }

        function addMcqs(Request $request){

            $request->validate([
                "question"=>"required | min:5",
                "a"=>"required",
                "b"=>"required",
                "c"=>"required",
                "d"=>"required",
                "correct_ans"=>"required",

            ]);
            $mcq= new Mcq();
            $quiz= Session::get('quizDetails');
            $admin= Session::get('admin');
            $mcq->question= $request->question;
            $mcq->a= $request->a;
            $mcq->b= $request->b;
            $mcq->c= $request->c;
            $mcq->d= $request->d;
            $mcq->correct_ans= $request->correct_ans;
            $mcq->admin_id= $admin->id;
            $mcq->quiz_id= $quiz->id;
            $mcq->category_id= $quiz->category_id;
            if($mcq->save()){
                if($request->submit=="add-more"){
                    return redirect(url()->previous());
                }else{
                    Session::forget('quizDetails');
                    return redirect("/add-quiz");
                }
            }
        }

        function endQuiz(){
            Session::forget('quizDetails');
            return redirect("add-quiz");
        }

        function showQuiz($id, $quizName){
            $admin= Session::get('admin');
            $mcqs= Mcq::where('quiz_id', $id)->get();
            if($admin){
                return view('01_Laravel_Project.show-quiz', ["name"=>$admin->name, "mcqs"=>$mcqs, "quizName"=>$quizName]);
            }else{
                return redirect('admin-login');
            }
        }

        function quizlist($id, $category){
            $admin=Session::get('admin');
            if($admin){
                $quizData=Quiz::where('category_id', $id)->get();
                return view('01_Laravel_Project.quiz-list', ["name"=>$admin->name, "quizData"=>$quizData, 'category'=>$category]);
            }else{
                return redirect('admin-login');
            }
          }
}