<section class="max-w-xl w-full bg-white dark:bg-gray-800 rounded-xl shadow-xl overflow-hidden mt-6">
    <!-- Header avec design amélioré -->
    <div class="bg-gradient-to-r from-red-500 to-pink-500 p-6 relative">
        <div class="absolute inset-0 bg-pattern opacity-10"></div>
        <h2 class="text-2xl font-bold text-white relative z-10 flex items-center">
            <i class="fas fa-user-slash mr-3 text-3xl"></i>
            {{ __('Delete Account') }}
        </h2>
        <p class="mt-2 text-sm text-white text-opacity-90 relative z-10">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>
    
    <!-- Zone de bouton -->
    <div class="p-6">
        <button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="px-5 py-2.5 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg shadow hover:shadow-lg focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all duration-200 flex items-center"
        >
            <i class="fas fa-trash-alt mr-2"></i>
            {{ __('Delete Account') }}
        </button>
    </div>

    <!-- Modal de confirmation -->
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-xl">
            <!-- En-tête du modal -->
            <div class="bg-gradient-to-r from-red-500 to-pink-500 p-4 relative">
                <div class="absolute inset-0 bg-pattern opacity-10"></div>
                <h2 class="text-xl font-bold text-white relative z-10 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>
            </div>
            
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300 sr-only">
                        {{ __('Password') }}
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input 
                            id="password"
                            name="password"
                            type="password"
                            class="pl-10 w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 py-3 px-4 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-red-500 dark:focus:ring-red-600 transition duration-200"
                            placeholder="{{ __('Password') }}"
                        />
                    </div>
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button 
                        type="button" 
                        x-on:click="$dispatch('close')"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-200"
                    >
                        {{ __('Cancel') }}
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white font-medium rounded-lg shadow hover:shadow-md focus:ring-2 focus:ring-red-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition duration-200 flex items-center"
                    >
                        <i class="fas fa-trash-alt mr-2"></i>
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>

<!-- Style pour le fond avec motif -->
<style>
    .bg-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'/%3E%3C/svg%3E");
    }
</style>