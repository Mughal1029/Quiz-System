<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Categories Page</title>
    @vite('resources/css/app.css')

</head>
<body>
<x-navbar name={{$name}}></x-navbar>

    <div class="bg-gray-100 flex flex-col items-center min-h-screen pt-5">
        <h2 class="text-5xl text-blue-800 mb-6">Users List</h2>
<div class="w-200">
    <ul class="border border-gray-200">
        <li class="p-2 font-bold">
            <ul class="flex justify-between">
                <li class="w-10">S. No</li>
                <li class="w-80">Name</li>
                <li class="w-110">Email</li>
            </ul>
        </li>

        @foreach($users as $key=>$item)
        <li class="even:bg-gray-300 p-2">
            <ul class="flex justify-between">
                <li class="w-10">{{$key+1}}</li>
                <li class="w-80">{{$item->name}}</li>
                <li class="w-110">{{$item->email}}</li>
            </ul>
        </li>
        @endforeach
    </ul>
</div>
<div>
    {{$users->links()}}
</div>
    </div>
</body>
</html>