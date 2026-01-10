<!DOCTYPE html>
<html lang="en">
<head>
    <title>str_replace('-',' ',$quizName)</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
     @if(session('message-success'))
        <div>
            <p class="text-green-500 font-bold">{{session('message-success')}}</p>
        </div>
        @endif
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <h1 class="text-4xl text-center text-green-800 nb-6 font-bold">{{str_replace('-',' ',$quizName)}}</h1>
        <h2 class="text-lg text-center text-green-800 nb-6 font-bold">This Quiz contain {{$count->count()}} Questions and no limit to attempt this Quiz</h2>
        <h3 class="text-2xl text-center text-green-800 nb-6 font-bold">Good Luck</h3>
        @if(session('user'))
            <a type="submit" href="/mcq/{{session('firstMcq')->id.'/'.$quizName}}" class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white">Start Quiz</a>
        @else    
            <button type="submit" class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white"><a href="/user-signup">SignUp for Start Quiz</a></button>
            <button type="submit" class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white"><a href="/user-login">Login for Start Quiz</a></button>
        @endif
    </div>
</body>
</html>