<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Login</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-sm">

        <h2 class="text-2xl text-center text-gray-800 mb-6">Admin Login</h2>
        @error('user')
        <div class="text-red-500">{{$message}}</div>
        @enderror

        <form action="login1" method="post" class="space-y-4">
            @csrf
            <div>
                <label for="" class="text-gray-600 mb-1">Admin name</label>
                <input type="text" name="name" placeholder="Enter Admin Name" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl ">
                @error('name')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <div>
                <label for="" class="text-gray-600 mb-1">Password</label>
                <input type="password" name="password" placeholder="Enter Your Password" autocomplete="off"
                class="w-full px-4 py-2 border border-gray-300 rounded-xl" >
                @error('password')
                <div class="text-red-500">{{$message}}</div>
                @enderror
            </div>
            <button type="submit" class="w-full bg-blue-500 rounded-xl px-2 py-2 text-white">Login</button>
        </form>
    </div>
</body>
</html>