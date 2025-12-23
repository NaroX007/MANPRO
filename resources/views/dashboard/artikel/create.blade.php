<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Artikel') }}
            </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h1 class="text-2xl font-bold mb-6">Add News</h1>
                    
                    <form action="{{ route('artikel.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <!-- Title -->
                        <div>
                            <x-input-label for="nama" :value="('nama')" />
                            <x-text-input 
                                id="nama" 
                                name="nama" 
                                type="text" 
                                class="block mt-1 w-full" 
                                :value="old('nama')" 
                                required 
                                autofocus />
                            <x-input-error :messages="$errors->get('nama')" class="mt-2" />
                        </div>

                        <!-- deskripsi -->
                        <div>
                            <x-input-label for="deskripsi" :value="('deskripsi')" />
                            <div 
                                id="editor" 
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300"
                                style="height: 200px; border: 1px solid #ced4da; background: white;">
                            </div>
                            <input type="hidden" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}" />
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <!-- Image -->
                        <div>
                            <x-input-label for="image" :value="('Image')" />
                            <x-text-input 
                                id="image" 
                                name="image" 
                                type="file" 
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
        
                        <!-- Submit Button -->
                        <div>
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
