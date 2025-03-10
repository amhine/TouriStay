<!DOCTYPE html>
<html lang="en" class="h-full bg-gradient-to-br from-purple-400 via-pink-500 to-red-500">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extreme Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="h-full flex items-center justify-center p-4">
    <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-8 shadow-2xl w-full max-w-md  ">
        <h2 class="text-4xl font-extrabold text-white mb-6 text-center ">Sign In</h2>
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
           
            <div class="input-field relative">
                <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 " placeholder="Email Address">
                <i class="fas fa-envelope absolute right-3 top-3 text-white"></i>
            </div>
            <div class="input-field relative">
                <input type="password" id="password" name="password" required class="w-full px-4 py-3 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200 " placeholder="Password">
                <i class="fas fa-lock absolute right-3 top-3 text-white"></i>
            </div>
          
            <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-105">
                Sign In
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
        <p class="text-white text-center mt-6">
            Mot de passe oublié ?
            <a href="{{ route('password.request') }}" class="font-bold hover:underline">Password</a>
        </p>
    </div>
</body>
</html>
