<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Pantai Air Manis
  </title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>
  <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }
        .forecast {
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .forecast h3 {
            margin: 0;
        }
        .forecast img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
            vertical-align: middle;
        }
        .forecast p {
            margin: 5px 0;
        }
        .leaflet-routing-container {
            display: none; /* Sembunyikan panel teks instruksi rute */
        }
    </style>
 </head>
 <body class="bg-gray-100">
    @include('ui.navbar')
 @php
    $alamat = $camp_ground->alamat;
    $pattern = "/Jl\..+?, ([^,]+), Kec\. ([^,]+), Kota ([^,]+), (.+)/";
    preg_match($pattern, $alamat, $matches);

    // Menyimpan hasil ke variabel
    $desa = $matches[1] ?? null;      // 'Lubuk Lintah'
    $kec = $matches[2] ?? null;       // 'Kuranji'
    $kota = $matches[3] ?? null;      // 'Padang'
    $provinsi = $matches[4] ?? null;
    @endphp
  <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
   <div class="relative">
    <img alt="Sunset view at Pantai Air Manis" class="w-full h-64 object-cover" height="300" src="{{ asset('storage/' . $camp_ground->image) }}" width="800"/>
    <div class="absolute bottom-0 left-0 p-6 bg-gradient-to-t from-black to-transparent text-white">
     <h1 class="text-3xl font-bold">
      {{ $camp_ground->nama }}
     </h1>
     <p class="text-lg">
    
      Kota {{ $kota }}, Kecamatan {{ $kec }}
     </p>
    </div>
   </div>
   <div class="p-6">
    <div class="flex items-center space-x-4">
     <button class="p-2 bg-gray-200 rounded-full">
      <i class="fas fa-chevron-left">
      </i>
     </button>
     @if ($images->count())
     <div class="flex space-x-2 overflow-x-auto">
     @foreach ($images as $image)
      <img  class="w-24 h-24 object-cover rounded-lg" height="100" src="{{ asset('storage/' . $image->image) }}" width="100" alt="Image {{ $loop->index + 1 }}"/>
      @endforeach
     </div>
     @else
        <p>No additional images available.</p>
    @endif
     <button class="p-2 bg-gray-200 rounded-full">
      <i class="fas fa-chevron-right">
      </i>
     </button>
    </div>
    <div class="mt-6">
     <h2 class="text-2xl font-bold">
        Deskripsi
         </h2>
         <p class="mt-2 text-gray-700">
             {!! $camp_ground->deskripsi !!}
     </p>
    </div>
    <div class="mt-6">
     <h2 class="text-2xl font-bold">
      Fasilitas Umum
     </h2>
     <div class="mt-4 p-4 bg-gray-100 rounded-lg">
      <ul class="space-y-2">
      @foreach ($fasilitas as $item)
      
       <li class="flex items-start space-x-2">
       @if($item->jenis_fasilitas == 'toilet dan air')
        <i class="fas fa-water text-xl"></i>
        @elseif($item->jenis_fasilitas == 'mesjid')
        <i class="fas fa-mosque text-xl">
        </i>
        @elseif($item->jenis_fasilitas == 'parkir')
        <i class="fas fa-money-bill-wave text-xl">
        </i>
        @elseif($item->jenis_fasilitas == 'keamanan')
        <i class="fas fa-shield-alt text-xl">
        </i>
        @elseif($item->jenis_fasilitas == 'lokasi tenda')
        <i class="fas fa-campground text-xl">
        </i>
        @else
        <i class="fas fa-question-circle text-xl">
        @endif
        
        </i>
        <span>
         {{ $item->deskripsi }}
        </span>
       </li>
       @endforeach
       
      </ul>
     </div>
    </div>
    <div class="mt-6">
    <div class="mt-6">
    <div class="mt-4 p-4 bg-gray-100 rounded-lg">
        <div id="map-show" style="height: 400px;"></div>
    </div>
    </div>
    </div>
    <div class="mt-6">
        <h1>4 hari perkiraan cuaca</h1>
        <div id="forecast" class="flex"></div>
    </div>
   </div>
  </div>      

  @include('ui.footer')
  <script>
    let latitude = {{ $camp_ground->latitude ?? -7.250445 }};
    let longitude = {{ $camp_ground->longitude ?? 112.768845 }};
    let apiKey = '0a59d481bace240ae31fb3bfa453958f';
        fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=${latitude}&lon=${longitude}&appid=${apiKey}`)
        .then(response => response.json())
            .then(data => {
                let forecastContainer = document.getElementById('forecast');
                
                let days = data.list.slice(0, 4); // Mengambil 4 hari data forecast
                let additionalDays = 0;
                days.forEach((day, index) => {
                    let now = new Date(); // Mendapatkan tanggal dan waktu sekarang
                    let currentDateNumber = now.getTime();
                    let nextDateNumber = currentDateNumber + ( additionalDays * 86400 * 1000); // Tanggal yang akan ditampilkan
                    console.log(nextDateNumber);
                    let date = new Date(nextDateNumber);
                    console.log(date) // Konversi timestamp ke format tanggal dengan waktu lokal
                    let temperatureMin = Math.round(day.main.temp_min - 273.15); // Konversi Kelvin ke Celsius
                    let temperatureMax = Math.round(day.main.temp_max - 273.15);
                    let condition = day.weather[0].description;
                    let icon = day.weather[0].icon;
                    let humidity = day.main.humidity;

                    // Format tanggal dan nama hari
                    let dayName = date.toLocaleString('default', { weekday: 'long' }); // Nama hari
                    let formattedDate = date.toLocaleDateString(); // Tanggal
                    additionalDays = additionalDays + 1;
                    forecastContainer.innerHTML += `
                        <div class="forecast">
                            <h3>${dayName} - ${formattedDate}</h3>
                            <img src="https://openweathermap.org/img/wn/${icon}.png" alt="${condition}">
                            <p>Temperature: L:${temperatureMin}° / H:${temperatureMax}°</p>
                            <p>Condition: ${condition.charAt(0).toUpperCase() + condition.slice(1)}</p>
                            <p>Humidity: ${humidity}%</p>
                        </div>
                    `;
                });
            })
            .catch(error => console.error('Error fetching weather data:', error));
    </script>
  <script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Koordinat Destinasi (Camping Ground dari Database)
    let destLat = {{ $camp_ground->latitude ?? -7.250445 }};
    let destLng = {{ $camp_ground->longitude ?? 112.768845 }};

    // 2. Inisialisasi Peta awal (titik tengah ke destinasi)
    const map = L.map('map-show').setView([destLat, destLng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Marker Lokasi Camping
    L.marker([destLat, destLng]).addTo(map)
        .bindPopup('<b>{{ $camp_ground->nama }}</b><br>Lokasi Tujuan')
        .openPopup();

    // 3. Otomatis Lacak Lokasi dan Buat Rute
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            let userLat = position.coords.latitude;
            let userLng = position.coords.longitude;

            // Tambahkan rute dari lokasi user ke destinasi
            L.Routing.control({
                waypoints: [
                    L.latLng(userLat, userLng), // Titik A (User)
                    L.latLng(destLat, destLng)  // Titik B (Camping)
                ],
                routeWhileDragging: false,
                addWaypoints: false, // User tidak bisa menambah titik di jalan
                draggableWaypoints: false, // Titik rute tidak bisa digeser
                lineOptions: {
                    styles: [{ color: '#3b82f6', weight: 6, opacity: 0.8 }]
                },
                createMarker: function() { return null; } // Menghilangkan marker default routing
            }).addTo(map);

            // Tambahkan marker khusus untuk posisi user
            L.marker([userLat, userLng]).addTo(map)
                .bindPopup('Lokasi Anda Sekarang');

        }, function(error) {
            console.warn("Izin lokasi ditolak atau error: " + error.message);
            // Jika user menolak lokasi, peta hanya akan menampilkan marker tujuan saja.
        });
    } else {
        console.error("Browser tidak mendukung Geolocation.");
    }
});
</script>


<script>
let latitude = {{ $camp_ground->latitude ?? -7.250445 }};
let longitude = {{ $camp_ground->longitude ?? 112.768845 }};
let apiKey = '0a59d481bace240ae31fb3bfa453958f';
console.log(latitude, longitude);
console.log(`https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&appid=${apiKey}`);
fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=44.34&lon=10.99&appid=8a1fbd1a3fd9e2b8e4aea73a0ee0432b`)
  .then(response => response.json())
  .then(data => {
    let dailyWeather = data.daily; // Mendapatkan ramalan cuaca untuk besok dan lusa
    console.log(dailyWeather);
  })
  .catch(error => console.error('Error fetching weather data:', error));
</script>
 </body>

</html>
