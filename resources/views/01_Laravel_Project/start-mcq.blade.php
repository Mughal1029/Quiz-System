<!DOCTYPE html>
<html lang="en">
<head>
    <title>Mcq Page</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <h1 class="text-4xl text-center text-green-800 nb-6 font-bold">{{$quizName}}</h1>
       <h2 class="text-2xl text-center text-green-800 mb-6 font-bold">Question No. {{session('currentQuiz')['totalMcq']}}</h2>

       <h2 class="text-2xl text-center text-green-800 mb-6 font-bold">{{session('currentQuiz')['currentMcq']}} of {{session('currentQuiz')['totalMcq']}}</h2>

       <div class="mt-2 p-4 bg-white shadow-2xl rounded-xl w-140">
        <h3 class="text-green-900 font-bold text-xl mb-1">{{$mcqData->question}}</h3>
        <form action="/submit-next/{{$mcqData->id}}" method="post" class="space-y-4">
            @csrf
            <input type="hidden" name="id" value="{{$mcqData->id}}">
            <label for="option-1" class="flex border p-3 mt-2 rounded-2xl shadow-2xl   cursor-pointer hover:bg-blue-50">
                <input type="radio" name="option" value="a" id="option-1" class="form-radio text-blue-500">
                <span class="text-green-900 pl-2">{{$mcqData->a}}</span>
            </label>
            <label for="option-2" class="flex border p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
                <input type="radio" name="option" value="b" id="option-2" class="form-radio text-blue-500">
                <span class="text-green-900 pl-2">{{$mcqData->b}}</span>
            </label>
            <label for="option-3" class="flex border p-3 mt-2 rounded-2xl shadow-2xl cursor-pointer hover:bg-blue-50">
                <input type="radio" name="option" value="c" id="option-3" class="form-radio text-blue-500">
                <span class="text-green-900 pl-2">{{$mcqData->c}}</span>
            </label>
            <label for="option-4" class="flex border p-3 mt-2 rounded-2xl shadow-2xl  cursor-pointer hover:bg-blue-50">
                <input type="radio" name="option" value="d" id="option-4" class="form-radio text-blue-500">
                <span class="text-green-900 pl-2">{{$mcqData->d}}</span>
            </label>
            <button type="submit" class="w-full bg-blue-500 rounded-xl px-2 py-2 text-white">Submit Answer and Next</button>
        </form>
       </div>
    </div>
    <x-footer-user></x-footer-user>
</body>
</html>