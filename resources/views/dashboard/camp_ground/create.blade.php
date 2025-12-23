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

                    <h1 class="text-2xl font-bold mb-6">Add News</h1>
                    
                    <form action="{{ route('camp.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                        <!--kategori -->
                        <div>
                            <label for="kategori" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300" >pilih kategori</label>
                            <select name="kategori" class="form-control mt-1 block w-full rounded-md border-gray-300 dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700" required>
                                <option value="Pantai">Pantai</option>
                                <option value="Gunung">Gunung</option>
                                <option value="Danau">Danau</option>
                            </select>
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

                        <div>
                            <x-input-label for="alamat" :value="('alamat')" />
                            <x-text-input 
                                id="alamat" 
                                name="alamat" 
                                type="text" 
                                class="block mt-1 w-full" 
                                :value="old('alamat')" 
                                required 
                                autofocus />
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>


                        <div>
                            <x-input-label for="fasilitas" :value="('Fasilitas')" />
                            <div id="fasilitas-container" class="space-y-4">
                                <div class=" space-x-4">
                                    <div class="block mt-1 w-full">
                                        <label for="fasilitas[0][jenis_fasilitas]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Fasilitas</label>
                                        <select 
                                            name="fasilitas[0][jenis_fasilitas]" 
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700">
                                            <option value="toilet dan air">Toilet dan Air</option>
                                            <option value="mesjid">Mesjid</option>
                                            <option value="parkir">Parkir</option>
                                            <option value="keamanan">Keamanan</option>
                                            <option value="lokasi tenda">Lokasi Tenda</option>
                                        </select>
                                    </div>
                                    <div class="block mt-1 w-full">
                                        <label for="fasilitas[0][deskripsi]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                                        <textarea 
                                            name="fasilitas[0][deskripsi]" 
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700" 
                                            rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2 mt-4">
                                <button type="button" id="add-fasilitas" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                    Tambah Fasilitas
                                </button>
                                <button type="button" id="remove-fasilitas" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                    Hapus Fasilitas
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('fasilitas')" class="mt-2" />
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




                        <div>
                            <x-input-label for="phone" :value="('phone')" />
                            <x-text-input 
                                id="phone" 
                                name="phone" 
                                type="text" 
                                class="block mt-1 w-full" 
                                :value="old('phone')" 
                                required 
                                autofocus />
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="map" :value="('Map')" />
                            <div id="map" class="block mt-1 w-full" style="height: 400px; border-radius: 8px;"></div>
                        </div>
                        
                        <!-- Latitude -->
                        <div>
                            <x-input-label for="latitude" :value="('Latitude')" />
                            <x-text-input 
                                id="latitude" 
                                name="latitude" 
                                type="text" 
                                class="block mt-1 w-full" 
                                :value="old('latitude')" 
                                required 
                                readonly />
                            <x-input-error :messages="$errors->get('latitude')" class="mt-2" />
                        </div>
                        
                        <!-- Longitude -->
                        <div>
                            <x-input-label for="longitude" :value="('Longitude')" />
                            <x-text-input 
                                id="longitude" 
                                name="longitude" 
                                type="text" 
                                class="block mt-1 w-full" 
                                :value="old('longitude')" 
                                required 
                                readonly />
                            <x-input-error :messages="$errors->get('longitude')" class="mt-2" />
                        </div>

                        <div id="images-container" class="space-y-4">
                            <div class="image-entry">
                                <div class="mb-4">
                                    <x-input-label for="images[0]" :value="__('Additional Image')" />
                                    <input 
                                        type="file" 
                                        name="images[0][file]" 
                                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700" 
                                        accept="image/*" />
                                    <x-input-error :messages="$errors->get('images')" class="mt-2" />
                                </div>

                            </div>
                        </div>

                        <!-- Button to add more image fields -->
                        <div class="flex items-center space-x-2 mt-4">
                            <button type="button" id="add-image-button" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                Tambah Gambar
                            </button>
                            <button type="button" id="remove-image-button" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                Hapus Gambar
                            </button>
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

<script>
    let fasilitasIndex = 1;

    // Tambah fasilitas
    document.getElementById('add-fasilitas').addEventListener('click', function () {
        const container = document.getElementById('fasilitas-container');
        const div = document.createElement('div');
        div.classList.add('fasilitas-entry', 'rounded', 'relative', 'mt-4');
        div.innerHTML = `
            <div class="block mt-1 w-full">
                <label for="fasilitas[${fasilitasIndex}][jenis_fasilitas]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Fasilitas</label>
                <select 
                    name="fasilitas[${fasilitasIndex}][jenis_fasilitas]" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700">
                    <option value="toilet dan air">Toilet dan Air</option>
                    <option value="mesjid">Mesjid</option>
                    <option value="parkir">Parkir</option>
                    <option value="keamanan">Keamanan</option>
                    <option value="lokasi tenda">Lokasi Tenda</option>
                </select>
            </div>
            <div class="block mt-1 w-full">
                <label for="fasilitas[${fasilitasIndex}][deskripsi]" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
                <textarea 
                    name="fasilitas[${fasilitasIndex}][deskripsi]" 
                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700" 
                    rows="4"></textarea>
            </div>
        `;
        container.appendChild(div);
        fasilitasIndex++;
    });

    // Hapus fasilitas terakhir
    document.getElementById('remove-fasilitas').addEventListener('click', function () {
        const container = document.getElementById('fasilitas-container');
        if (container.lastElementChild) {
            container.lastElementChild.remove();
        }
    });

    // Tambah gambar
    document.getElementById('add-image-button').addEventListener('click', function () {
        const container = document.getElementById('images-container');
        const index = container.getElementsByClassName('image-entry').length;
        const newEntry = `
            <div class="image-entry rounded relative mt-4">
                <div class="mb-4">
                    <x-input-label for="images[${index}]" :value="'Additional Image'" />
                    <input 
                        type="file" 
                        name="images[${index}][file]" 
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm dark:bg-gray-900 dark:text-gray-300 dark:border-gray-700" 
                        accept="image/*" />
                </div>
            </div>`;
        container.insertAdjacentHTML('beforeend', newEntry);
    });

    // Hapus gambar terakhir
    document.getElementById('remove-image-button').addEventListener('click', function () {
        const container = document.getElementById('images-container');
        if (container.lastElementChild) {
            container.lastElementChild.remove();
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Inisialisasi peta
        const map = L.map('map').setView([-6.200000, 106.816666], 13); // Default: Jakarta

        // Tambahkan layer peta
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Tambahkan marker untuk menunjukkan lokasi yang dipilih
        let marker = L.marker([-6.200000, 106.816666], { draggable: true }).addTo(map);

        // Fungsi untuk memperbarui nilai latitude dan longitude
        function updateLatLng(lat, lng) {
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
        }

        // Perbarui koordinat saat marker digeser
        marker.on('dragend', function (e) {
            const { lat, lng } = e.target.getLatLng();
            updateLatLng(lat, lng);
        });

        // Tangkap klik pada peta dan pindahkan marker
        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            marker.setLatLng([lat, lng]);
            updateLatLng(lat, lng);
        });
    });
</script>