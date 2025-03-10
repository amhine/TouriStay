<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Utilisateur - TouriStay 2030</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/3.10.3/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen flex items-center justify-center p-4">
    
    <section class="max-w-xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden">
        <!-- Header avec design amélioré -->
        <div class="bg-gradient-to-r from-green-500 to-blue-500 p-6 relative">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <h2 class="text-2xl font-bold text-white relative z-10 flex items-center">
                <i class="fas fa-user-circle mr-3 text-3xl"></i>
                Informations du profil
            </h2>
            <p class="mt-2 text-sm text-white text-opacity-90 relative z-10">
                Mettez à jour les informations de votre profil et votre adresse email.
            </p>
        </div>
        
        <!-- Contenu des formulaires -->
        <div class="p-6">
            <!-- Formulaire caché pour la vérification -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>
            
            <!-- Formulaire principal -->
            <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                @csrf
                @method('patch')
                
                <!-- Champ Nom avec design amélioré -->
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Nom
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input id="name" name="name" type="text" 
                            class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 py-3 px-4 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 transition duration-200"
                            value="{{ old('name', $user->name) }}" 
                            required autofocus autocomplete="name" />
                    </div>
                    <x-input-error class="mt-2 text-sm text-red-600 dark:text-red-400" :messages="$errors->get('name')" />
                </div>
                
                <!-- Champ Email avec design amélioré -->
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input id="email" name="email" type="email" 
                            class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 py-3 px-4 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 dark:focus:ring-green-600 transition duration-200"
                            value="{{ old('email', $user->email) }}" 
                            required autocomplete="username" />
                    </div>
                    <x-input-error class="mt-2 text-sm text-red-600 dark:text-red-400" :messages="$errors->get('email')" />
                    
                    <!-- Alerte de vérification d'email -->
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-4 rounded-lg bg-amber-50 dark:bg-amber-900/40 border-l-4 border-amber-400 dark:border-amber-500 p-4">
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-amber-500 dark:text-amber-400 mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-sm text-amber-700 dark:text-amber-300">
                                        Votre adresse email n'est pas vérifiée.
                                    </p>
                                    <button form="send-verification" 
                                        class="mt-1 text-sm font-medium text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 focus:outline-none focus:underline transition duration-150">
                                        Cliquez ici pour renvoyer l'email de vérification
                                    </button>
                                    
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                
                <!-- Section des boutons avec une meilleure présentation -->
                <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <button type="submit" 
                            class="px-5 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white font-medium rounded-lg shadow hover:shadow-lg focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 flex items-center">
                            <i class="fas fa-save mr-2"></i>
                            Enregistrer
                        </button>
                        
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm font-medium text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 py-1 px-3 rounded-full flex items-center">
                                <i class="fas fa-check mr-1"></i> Enregistré
                            </p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>
    
    <!-- Style pour le fond avec motif -->
  
    <style>
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
    </style>
</body>
</html>