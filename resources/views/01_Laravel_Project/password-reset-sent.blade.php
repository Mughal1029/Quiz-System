<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    @vite('resources/css/app.css')

</head>
<body>
    <x-user-navbar></x-user-navbar>
    <div class="text-center mt-20">
        <h2>Password Reset Requested</h2>
        @if(session('message-success'))
            <div>
                <p class="text-green-500 font-bold">{{session('message-success')}}</p>
            </div>
            @endif
        <p>If an account exists with this email, we have sent a password reset link.</p>
        <button class="bg-blue-500 rounded-md px-4 py-2 my-5 text-white">
            <a  href="/user-login">Back to Login</a>
        </button>
    </div>
    
</body>
</html>















