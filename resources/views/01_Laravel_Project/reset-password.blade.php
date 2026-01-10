<!DOCTYPE html>
<html lang="en">
<head>
    <title>Set Password</title>
    @vite('resources/css/app.css')
</head>
<body>
    <x-user-navbar></x-user-navbar>
<div class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">

        <h2 class="text-2xl text-center text-green-800 mb-6">Set Password</h2>

        <form action="/reset-password" method="post" class="space-y-4">
            @csrf
            <div>
                <input type="hidden" name="email" placeholder="Enter User Email" autocomplete="off" value="{{ $email }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl ">
                @error('email')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">New Password</label>
                <input type="password" name="password" placeholder="Enter New Password" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl" >
                @error('password')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
             <div>
                <label for="" class="text-gray-600 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" placeholder="Confirm New Password" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl" >
            </div>
            <button type="submit" class="w-full bg-blue-500 rounded-xl px-2 py-2 text-white">Update Password</button>
        </form>
    </div>
</div>
</body>
</html>