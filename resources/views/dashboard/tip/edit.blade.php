<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tips') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Form Edit -->
                    <form action="{{ route('tip.update', $tip->id) }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Nama -->
                        <!-- Title -->
                        <div>
                            <x-input-label for="nama" :value="('nama')" />
                            <x-text-input 
                                id="nama" 
                                name="nama" 
                                type="text" 
 
                                value="{{ old('nama', $tip->nama) }}"
                                required 
                                class="block mt-1 w-full"
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
                            <input type="hidden" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $tip->deskripsi) }}" />
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
                        <div class="flex justify-end gap-2">
                            <a href="{{ route('tip.index') }}" class="m-4 bg-gray-500 px-4 py-2 text-white hover:text-gray-800 rounded-md">
                                {{ __('Cancel') }}
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-300 disabled:opacity-25 transition">
                                {{ __('Update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>