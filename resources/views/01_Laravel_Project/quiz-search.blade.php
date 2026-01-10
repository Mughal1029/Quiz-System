<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')

</head>
<body>
    <x-user-navbar></x-user-navbar>
      <div class="flex flex-col min-h-screen items-center bg-gray-100">
        <h1 class="text-4xl font-bold text-green-900 p-5">Check Your Skills</h1>
        <div class="w-full max-w-md">
            <div class="relative">
                <form action="quiz-search" method="get">
                    <input class="w-full px-4 py-3 text-gray-700 border border-gray-300 rounded-2xl shadow" type="text" name="search" placeholder="search quiz...">
                <button class="absolute right-2 top-3">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </button>
                </form>
            </div>
        </div>
    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <h2 class="text-2xl text-center text-green-900 font-bold mb-6">Search : {{$quiz}} List</h2>
    <div class="w-200">
       <a class="flex flex-left text-yellow-500" href="/us">Back</a>
    <ul class="border border-gray-200">
        <li class="p-2 font-bold">
            <ul class="flex justify-between">
                <li class="w-30">Quiz Id</li>
                <li class="w-110">Name</li>
                <li class="w-30">Mcq Count</li>
                <li class="w-30">Action</li>
            </ul>
        </li>

        @foreach($quizData as $item)
        <li class="even:bg-gray-300 p-2">
            <ul class="flex justify-between">
                <li class="w-30">{{$item->id}}</li>
                <li class="w-120">{{$item->name}}</li>
                <li class="w-20">{{$item->mcq_count}}</li>
                <li class="w-30">
                     <a href="/start-quiz/{{$item->id}}/{{str_replace(' ','-',$item->name)}}" class="text-green-500 font-bold">Attempt Quiz</a>
                </li>
            </ul>
        </li>
        @endforeach
    </ul>
</div>
    </div>
</body>
</html>