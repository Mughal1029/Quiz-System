<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Signup</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">

        <h2 class="text-2xl text-center text-green-800 mb-6">User Signup</h2>

        <form action="user-signup" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="" class="text-gray-600 mb-1">User Name</label>
                <input type="text" name="name" placeholder="Enter User Name" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl ">
                @error('name')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">User Email</label>
                <input type="text" name="email" placeholder="Enter User Email" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl ">
                @error('email')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">Password</label>
                <input type="password" name="password" placeholder="Enter User Password" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl" >
                @error('password')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
             <div>
                <label for="" class="text-gray-600 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm User Password" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl" >
            </div>
            <button type="submit" class="w-full bg-blue-500 rounded-xl px-2 py-2 text-white">Signup</button>
        </form>
    </div>
</div>
</body>
</html>