<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Camp') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <h1 class="text-2xl font-bold mb-6">News List</h1>

                    <div class="mb-4">
                        <a href="{{ route('camp.create') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 dark:focus:ring-gray-500 transition ease-in-out duration-150">
                             Add Camp
                        </a>
                    </div>


                    <!-- Table Section -->
                    <div id="non-form">
                        <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300 dark:border-gray-700">
                                <thead>
                                    <tr class="bg-gray-100 dark:bg-gray-700">
                                        <th class="px-4 py-2 border border-gray dark:border-gray-700 text-left text-sm font-medium">nama</th>
                                        <th class="px-4 py-2 border border-gray dark:border-gray-700 text-left text-sm font-medium">deskripsi</th>
                                        <th class="px-4 py-2 border border-gray dark:border-gray-700 text-left text-sm font-medium">alamat</th>
                                        <th class="px-4 py-2 border border-gray dark:border-gray-700 text-left text-sm font-medium">image</th>
                                        <th class="px-4 py-2 border border-gray dark:border-gray-700 text-left text-sm font-medium">phone</th>
                                        <th class="px-4 py-2 border border-gray dark:border-gray-700 text-left text-sm font-medium">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($camp as $new)
                                        <tr class="border-t border-gray-300 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800">
                                            <td class="px-4 py-2 text-sm hidden select-column">
                                                <input type="checkbox" name="selected_ids[]" value="{{ $new->id }}" class="select-item">
                                            </td>
                                            <td class="border border-gray dark:border-gray-700 text-left text-sm font-medium px-4 py-2 text-sm">{{ $new->nama }}</td>
                                            <td class="border border-gray dark:border-gray-700 text-left text-sm font-medium px-4 py-2 text-sm">{{ Str::limit(strip_tags($new->deskripsi), 20) }}</td>
                                            <td class="border border-gray dark:border-gray-700 text-left text-sm font-medium px-4 py-2 text-sm">{{ $new->alamat }}</td>
                                            <td class="px-4 py-2 text-sm">
                                            @if ($new->image)
                                                <img src="{{ asset('storage/' . $new->image) }}" 
                                                     alt="Image" 
                                                     class="w-24 h-16 object-cover rounded-md shadow-sm">
                                            @else
                                                <span class="text-gray-500">No Image</span>
                                            @endif
                                            </td>
                                            <td class="border border-gray dark:border-gray-700 text-left text-sm font-medium px-4 py-2 text-sm">{{ $new->phone }}</td>
                                            
                                            <td class="flex justify-center gap-4 border border-gray dark:border-gray-700 text-left text-sm font-medium px-4 py-2 text-sm">
                                                <a href="{{ route('camp.edit', $new->id) }}" class="rounded-md bg bg-gray-500 px-4 py-2 text-white hover:underline">Edit</a>
                                                <form action="{{ route('camp.destroy', $new->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="rounded-md bg bg-red-600 px-4 py-2 text-white hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No news found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>                            
                            </table>
                        </div>

                        <!-- Delete Selected Button -->
 
                    </div>

                    
                    <div id="delete-selected-btn-container" class="mt-4 hidden">
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete selected items?')">
                            Delete Selected
                        </button>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>