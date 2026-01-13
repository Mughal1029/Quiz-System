<?php
namespace App\Http\Controllers\Laravel_Project;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Spatie\Browsershot\Browsershot;

use Illuminate\Http\Request;
use App\Models\Laravel_Project\Category;
use App\Models\Laravel_Project\Quiz;
use App\Models\Laravel_Project\Mcq;
use App\Models\Laravel_Project\User;
use App\Models\Laravel_Project\Record;
use App\Models\Laravel_Project\Mcq_record;
use App\Mail\VerifyUser;
use App\Mail\UserForgetPassword;

class UserCont extends Controller
{
    function welcome() {
         $category=Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->take(5)->get();
         $quizData=Quiz::withCount('records')->orderBy('records_count', 'desc')->take(5)->get();
         
         // $category=Category::get();
         return view('01_Laravel_Project.welcome', ['categories'=>$category, 'quizData'=>$quizData]);
        }

    function categories(){
         $categori=Category::withCount('quizzes')->orderBy('quizzes_count', 'desc')->paginate(5);
        return view('01_Laravel_Project.categories-list',['categories'=>$categori]);
    }

    function userQuizlist($id, $category){
        $quizData=Quiz::withCount('Mcq')->where('category_id', $id)->get();
        return view('01_Laravel_Project.user-quiz-list', ["quizData"=>$quizData, 'category'=>$category]);
    }

    
    // function startQuiz($id, $name){
    //     $Count= Mcq::where('quiz_id', $id)->get();
    //     $quizName = $name;
    //     return view('01_Laravel_Project.start-quiz', ['quizName'=>$quizName, 'count1'=>$Count]);
    // }

    function startQuiz($id, $name){
    // 🔐 Sirf tab save karo jab user login na ho
    if (!Session::has('user')) {
        Session::put('quiz-url', url()->current());
    }
    $mcq = Mcq::where('quiz_id', $id)->get();
    Session::put('firstMcq', $mcq[0]);
    return view('01_Laravel_Project.start-quiz', [
        'quizName' => $name,
        'count'   => $mcq
    ]);
  }

    function userSignup(Request $req){
        $val= $req->validate([
            'name'=>'required | min :3',
            'email'=>'required | email | unique:users',
            'password'=>'required | min:3 | confirmed',
        ]);
           $user = User::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ]);
        
        $link= Crypt::encryptString($user->email);
        $link=url('/verify-user/'.$link);
        Mail::to($user->email)->send(new VerifyUser($link));

        if($user){
            Session::put('user', $user);
            if(Session::has('quiz-url')){
                return redirect(Session::pull('quiz-url'))->with('message-success',"User registered successfully, Please check email to verify account.");
            }
            return redirect('/us')->with('message-success',"User registered successfully, Please check email to verify account.");
        }
    }

    function verifyUser($email){
         $orgEmail = Crypt::decryptString($email);
        $user=User::where('email', $orgEmail)->first();
        if($user){
            $user->active=2;
            if($user->save()){
                 return redirect('/us')->with('message-success',"User verified successfully.");
            }
        }
    }

    function userForgetPassword(Request $request){ 
        $request->validate([
            'email'=>'required|email',
        ]);
        $user=User::where('email', $request->email)->first();
        if(!$user){
            return back()->withErrors(['email'=>'This email is not registered.']);
        }
        $forget=Crypt::encryptString($request->email);
        $forget=url('/user-forget-password/'.$forget);
        Mail::to($request->email)->send(new userForgetPassword($forget));
        return view('\01_Laravel_Project\password-reset-sent')->with('message-success',"Please check email to set new password.");
    }

    function userResetPassword($email){
        $originalEmail=Crypt::decryptString($email);
        return view('01_Laravel_Project.reset-password',['email'=>$originalEmail]);
    }

    function ResetPassword(Request $request){
         $validate=$request->validate([
                'email'=>'required | email',
                'password'=>'required | min:3 | confirmed',
        ]);
            $user = User::where('email', $request->email)->first();
            if ($user) { 
                $user->password = Hash::make($request->password);
                if($user->save()){
                    return redirect('/user-login')->with('message-success', 'Password updated successfully. Please login in with new password.');
                }
            }
    }

    function userLogout(){
        Session::forget('user');
        return redirect('/us');
    }

    // function userSignupQuiz(){
    //    return view('01_Laravel_Project.user-signup');
    // } 


    function userLogin(Request $req){
        $val= $req->validate([
            'email'=>'required | email',
            'password'=>'required',
        ]);
           $user = User::where('email', $req->email)->first();
           if(!$user || !Hash::check($req->password, $user->password)){
            return redirect("/user-login")->with('message-error',"User not valid, Please check email and password again.");
           }
        if($user){
            Session::put('user', $user);
            if(Session::has('quiz-url')){
                $url=Session::pull('quiz-url');
                // Session::forget('quiz-url');
                return redirect($url);
            }
            return redirect('/us');
        }
    }
    

    // function userLoginQuiz(){
    //    return view('01_Laravel_Project.user-login');
    // } 4m

    function mcq($id, $name){
        $record= new Record();
        $record->user_id=Session::get('user')->id;
        $record->quiz_id=Session::get('firstMcq')->quiz_id;
        $record->status=1;
        if($record->save()){
           $currentQuiz=[];
            $currentQuiz['totalMcq']=Mcq::where('quiz_id', Session::get('firstMcq')->quiz_id)->count();
            $currentQuiz['currentMcq']=1;
            $currentQuiz['quizName']=$name;
            $currentQuiz['quizId']=Session::get('firstMcq')->quiz_id;
            $currentQuiz['recordId']=$record->id;
            Session::put('currentQuiz', $currentQuiz);
            $mcqData=Mcq::find($id);
            return view('01_Laravel_Project.start-mcq', ['quizName'=>$name, 'mcqData'=>$mcqData]);
        }else{ return "Something went wrong";}
    }

    function submitandNext(Request $requ, $id){
       $currentQuiz=Session::get('currentQuiz');
       $currentQuiz['currentMcq']+=1;
       $mcqData= Mcq::where([
        ['id', '>', $id],
        ['quiz_id', '=', $currentQuiz['quizId']]
       ])->first();

       $isExists= Mcq_record::where([
        ['record_id', '=', $currentQuiz['recordId']],
        ['mcq_id', '=', $requ->id],
       ])->count();
       if ($isExists<1) {
           $mcq_record= new Mcq_record;
           $mcq_record->record_id=$currentQuiz['recordId'];
           $mcq_record->user_id=Session::get('user')->id;
           $mcq_record->mcq_id=$requ->id;
           $mcq_record->select_answer=$requ->option;
         if($requ->option == Mcq::find($requ->id)->correct_ans){
           $mcq_record->is_correct=1;
          }else{
            $mcq_record->is_correct=0;
          }
          if (!$mcq_record->save()) {
            return "something went wrong";
          }
    }
        Session::put('currentQuiz', $currentQuiz);
       if($mcqData){
              return view('01_Laravel_Project.start-mcq', ['quizName'=>$currentQuiz['quizName'], 'mcqData'=>$mcqData]);
        }else{
             $resultData=Mcq_record::withMcq()->where('record_id', $currentQuiz  ['recordId'])->get();
             $correctAnswer=Mcq_record::where([
                ['record_id', '=', $currentQuiz['recordId']],
                ['is_correct', '=', 1],
             ])->count();
             $record = Record::find($currentQuiz['recordId']);
             if($record){
                $record->status=2;
                $record->update();
             }
            return view("01_Laravel_Project.quiz-result", ['resultData'=>$resultData, 'correctAnswer'=>$correctAnswer]);
        }
    }
 
    function userDetails(){
        $quiz_record = Record::WithQuiz()->where('user_id', Session::get('user')->id)->get();
        return view('01_Laravel_Project.user-details', ['quizRecord'=>$quiz_record]);
    }

    function quizSearch(Request $requ){
       $quizData = Quiz::withCount('Mcq')->where('name', 'Like', '%'.$requ->search. '%')->get();
        return view("01_Laravel_Project.quiz-search", ['quizData'=>$quizData, 'quiz'=>$requ->search]);
    }

    function Certificate(){
        $data=[];
        $data['quiz']=str_replace('-',' ',Session::get('currentQuiz')['quizName']);
        $data['name']=Session::get('user')['name'];
        return view("01_Laravel_Project.certificate", ['data'=>$data]);
    }
function downCertificate() {
    $data = [];
    $data['quiz'] = str_replace('-', ' ', Session::get('currentQuiz')['quizName']);
    $data['name'] = Session::get('user')['name'];

    // HTML view render
    $pdfs = view("01_Laravel_Project.download-certificate", ['data' => $data])->render();

    // Browsershot PDF generate
    $pdfOutput = Browsershot::html($pdfs)
        ->setNodeBinary('C:/Program Files/nodejs/node.exe')
        ->setChromePath('C:/Program Files (x86)/Microsoft/Edge/Application/msedge.exe')
        ->noSandbox()
        ->timeout(120)
        ->showBackground()   // ← یہ line background کے لیے ضروری ہے
        ->format('A4')       // ← PDF format
        ->pdf();

    // Return PDF response
    return response($pdfOutput)
        ->withHeaders([
            'Content-Type' => "application/pdf",
            'Content-Disposition' => "attachment; filename=certificate.pdf",
        ]);
}








    // function sendEmail(){
    //     $to="mughal@com";
    //     $msg="dummy text";
    //     $subject="code step by step";
    //     Mail::to($to)->send(new VerifyUser($msg, $subject));
    // }

    // $request main jo to msg ya subject yha use huwa hy wo form ky name se  field se aye hy 

    // function sendsEmail(Requset $request){
    //     $to=$request->to;
    //     $msg=$request->msg;
    //     $subject=$request->subject;
    //     Mail::to($to)->send(new VerifyUser($msg, $subject));
    // }
}
