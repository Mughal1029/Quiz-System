<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Details</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="flex flex-col min-h-screen items-center bg-gray-100">
        <h1 class="text-4xl font-bold text-green-900 p-5">User Details</h1>
        <div class="w-200">
    <h3 class="text-2xl text-green-900 font-bold text-center my-5">Attempted Quiz</h3>
    <ul class="border border-gray-200">
         <li class="p-1 font-bold">
            <ul class="flex justify-between">
                <li class="w-20">S. No</li>
                <li class="w-150">Name</li>
                <li class="w-30">Status</li>
            </ul>
        </li>
       @foreach($quizRecord as $key=>$record)
       <li class="even:bg-gray-300 p-1">
        <ul class="flex justify-between">
            <li class="w-10">{{$key+1}}</li>
            <li class="w-150">{{$record->name}}</li>
            <li class="w-25">
                @if($record->status==2)
                <span class="text-green-500">Completed</span>
                @else
                <span class="text-red-500">Not Completed</span>
                @endif
            </li>
        </ul>
       </li>
       @endforeach
    </ul>
    
</div>

    </div>
    <x-footer-user></x-footer-user>
</body>
</html> 