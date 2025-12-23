<script>
  function setLocationInputs() {
    navigator.geolocation.getCurrentPosition(function(position) {
      // Ambil semua input dengan kelas 'latitude' dan 'longitude'
      let latitudeInputs = document.getElementsByClassName('latitude');
      let longitudeInputs = document.getElementsByClassName('longitude');

      // Isi input dengan lokasi yang didapatkan
      for (let i = 0; i < latitudeInputs.length; i++) {
        latitudeInputs[i].value = position.coords.latitude;
        longitudeInputs[i].value = position.coords.longitude;
      }
    });
  }

  // Panggil fungsi saat DOM selesai dimuat
  document.addEventListener('DOMContentLoaded', setLocationInputs);
</script>
<nav class="bg-white-800">
  <div class="mx-auto max-w-7xl max-h-15 px-2 pt-4 sm:px-6 lg:px-8">
    <div class="relative flex h-16 items-center justify-between">
      <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
        <!-- Mobile menu button-->
        <button type="button" class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
          <span class="absolute -inset-0.5"></span>
          <span class="sr-only">Open main menu</span>
          <!--
            Icon when menu is closed.

            Menu open: "hidden", Menu closed: "block"
          -->
          <svg class="block size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
          <!--
            Icon when menu is open.

            Menu open: "block", Menu closed: "hidden"
          -->
          <svg class="hidden size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div class="flex justify-center items-center sm:items-stretch sm:justify-start">
        <div class="flex shrink-0 items-center">
          <img class="h-20 w-auto" src="{{ asset('img/image1.png') }}" alt="Your Company">
        </div>
        <div class="flex flex-row">
          <div class="hidden sm:ml-6 sm:block lg:flex justify-center items-center ">
            <div class="flex space-x-4">
              <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
              <form action="{{ route('home') }}" method="GET">
                @csrf
                <input type="hidden" name="latitude" class="latitude">
                <input type="hidden" name="longitude" class="longitude">
                <button class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-700 hover:text-white" type="submit">Home</button>
              </form>
            </div>
          </div>
          <div class="hidden sm:ml-6 sm:block lg:flex justify-between items-center ">
            <div class="flex space-x-4">
              <!-- Dropdown -->
              <form class="flex" action="{{ route('campground') }}" method="GET">
                <div class="relative group">
                  <button class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-700 hover:text-white focus:outline-none">
                    Menu
                  </button>
                  <div class="z-10 absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg opacity-0 scale-95 transition-opacity duration-300 ease-in-out group-hover:opacity-100 group-hover:scale-100">
                    @csrf
                    <input type="hidden" name="latitude" class="latitude hidden">
                    <input type="hidden" name="longitude" class="longitude hidden">
                    <button class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" type="submit">Lokasi camp</button>
                    <a href="{{ route ('artikel') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Artikel</a>
                    <a href="{{ route ('tip') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Tips</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- Mobile menu, show/hide based on menu state. -->
  <div class="sm:hidden" id="mobile-menu">
    <div class="space-y-1 px-2 pb-3 pt-2">
      <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
      <a href="#" class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white" aria-current="page">Home</a>
      <a href="#" class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Explore</a>
    </div>
  </div>
</nav>
