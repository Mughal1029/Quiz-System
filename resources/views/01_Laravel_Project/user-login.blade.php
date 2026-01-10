<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Login</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">
        @if(session('message-error'))
        <div>
            <p class="text-red-500 font-bold">{{session('message-error')}}</p>
        </div>
        @endif
        @if(session('message-success'))
        <div>
            <p class="text-green-500 font-bold">{{session('message-success')}}</p>
        </div>
        @endif
        <h2 class="text-2xl text-center text-green-800 mb-6">User Login</h2>

        <form action="user-login" method="post" class="space-y-4">
            @csrf
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
            <button type="submit" class="w-full bg-blue-500 rounded-xl px-2 py-2 text-white">Login</button>
            <a href="user-forget-password" class="text-green-500">Forget Password</a>
        </form>
    </div>
</div>
</body>
</html>