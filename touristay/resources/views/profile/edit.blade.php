<x-app-layout>
    <!-- Navbar pour TouriStay -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-2">
            <div class="flex justify-between items-center">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-green-600">TouriStay</span>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="/dashboard/proprietaire" class="text-gray-700 hover:text-green-600 transition">Accueil</a>
                    <a href="/annonce" class="text-gray-700 hover:text-green-600 transition">Annonces</a>
                    <a href="/profile" class="text-gray-700 hover:text-green-600 transition">Profil</a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded bg-green-600 text-white hover:bg-green-700 transition">
                            Logout
                        </button>
                    </form>
                </div>
                <div class="md:hidden">
                    <button class="text-gray-700 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 ">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>