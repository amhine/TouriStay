<!DOCTYPE html>
<html lang="en" class="h-full bg-gradient-to-br from-purple-400 via-pink-500 to-red-500">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extreme Signup Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        /* Personnalisation des espaces pour éviter le défilement */
        @media (min-height: 800px) {
            .form-container {
                max-height: 95vh;
            }
        }
        
        /* Animation des champs de formulaire */
        .input-field {
            transition: transform 0.2s;
        }
        .input-field:focus-within {
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="bg-white bg-opacity-10 backdrop-blur-lg rounded-3xl p-6 shadow-2xl w-full max-w-md form-container">
        <h2 class="text-4xl font-extrabold text-white mb-4 text-center">Sign Up</h2>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-2">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div class="input-field relative col-span-2">
                    <input type="text" id="name" name="name" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Full Name">
                    <i class="fas fa-user absolute right-3 top-2 text-white"></i>
                </div>
                
                <div class="input-field relative col-span-2">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Email Address">
                    <i class="fas fa-envelope absolute right-3 top-2 text-white"></i>
                </div>
                
                <div class="input-field relative col-span-1">
                    <input type="password" id="password" name="password" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Password">
                    <i class="fas fa-lock absolute right-3 top-2 text-white"></i>
                </div>
                
                <div class="input-field relative col-span-1">
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Confirm">
                    <i class="fas fa-lock absolute right-3 top-2 text-white"></i>
                </div>
                
                <div class="input-field relative col-span-2">
                    <select id="role_id" name="role_id" class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white appearance-none">
                        <option class="text-black" value="0">Choisir votre rôle</option>
                        <option class="text-black" value="2">Touriste</option>
                        <option class="text-black" value="3">Propriétaire</option>
                    </select>
                    <i class="fas fa-user-tag absolute right-3 top-2 text-white"></i>
                </div>
                
                <div class="input-field relative col-span-2">
                    <input type="text" id="image" name="image" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Image URL">
                    {{-- <i class="fas fa-image absolute right-3 top-2 text-white"></i> --}}
                </div>
                
                <div class="input-field relative col-span-1">
                    <input type="text" id="numtel" name="numtel" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Téléphone">
                    <i class="fas fa-phone-alt absolute right-3 top-2 text-white"></i>
                </div>
                
                <div class="input-field relative col-span-1">
                    <input type="text" id="adress" name="adress" required class="w-full px-4 py-2 rounded-lg bg-white bg-opacity-20 focus:bg-opacity-30 focus:ring-2 focus:ring-purple-300 text-white placeholder-gray-200" placeholder="Adresse">
                    <i class="fas fa-map-marker-alt absolute right-3 top-2 text-white"></i>
                </div>
            </div>
            
            <button type="submit" class="w-full bg-gradient-to-r from-purple-500 to-pink-500 text-white font-bold py-3 px-4 rounded-lg hover:opacity-90 focus:ring-4 focus:ring-purple-300 transition duration-300 transform hover:scale-105 mt-4">
                Sign Up
                <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </form>
        
        <p class="text-white text-center mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-bold hover:underline">Log in</a>
        </p>
    </div>
</body>
</html>