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
    </style>
 </head>
 <body class="bg-gray-100">
    <?php echo $__env->make('ui.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php
    $alamat = $camp_ground->alamat;
    $pattern = "/Jl\..+?, ([^,]+), Kec\. ([^,]+), Kota ([^,]+), (.+)/";
    preg_match($pattern, $alamat, $matches);

    // Menyimpan hasil ke variabel
    $desa = $matches[1] ?? null;      // 'Lubuk Lintah'
    $kec = $matches[2] ?? null;       // 'Kuranji'
    $kota = $matches[3] ?? null;      // 'Padang'
    $provinsi = $matches[4] ?? null;
    ?>
  <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
   <div class="relative">
    <img alt="Sunset view at Pantai Air Manis" class="w-full h-64 object-cover" height="300" src="<?php echo e(asset('storage/' . $camp_ground->image)); ?>" width="800"/>
    <div class="absolute bottom-0 left-0 p-6 bg-gradient-to-t from-black to-transparent text-white">
     <h1 class="text-3xl font-bold">
      <?php echo e($camp_ground->nama); ?>

     </h1>
     <p class="text-lg">
    
      Kota <?php echo e($kota); ?>, Kecamatan <?php echo e($kec); ?>

     </p>
    </div>
   </div>
   <div class="p-6">
    <div class="flex items-center space-x-4">
     <button class="p-2 bg-gray-200 rounded-full">
      <i class="fas fa-chevron-left">
      </i>
     </button>
     <?php if($images->count()): ?>
     <div class="flex space-x-2 overflow-x-auto">
     <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <img  class="w-24 h-24 object-cover rounded-lg" height="100" src="<?php echo e(asset('storage/' . $image->image)); ?>" width="100" alt="Image <?php echo e($loop->index + 1); ?>"/>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
     </div>
     <?php else: ?>
        <p>No additional images available.</p>
    <?php endif; ?>
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
             <?php echo $camp_ground->deskripsi; ?>

     </p>
    </div>
    <div class="mt-6">
     <h2 class="text-2xl font-bold">
      Fasilitas Umum
     </h2>
     <div class="mt-4 p-4 bg-gray-100 rounded-lg">
      <ul class="space-y-2">
      <?php $__currentLoopData = $fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      
       <li class="flex items-start space-x-2">
       <?php if($item->jenis_fasilitas == 'toilet dan air'): ?>
        <i class="fas fa-water text-xl"></i>
        <?php elseif($item->jenis_fasilitas == 'mesjid'): ?>
        <i class="fas fa-mosque text-xl">
        </i>
        <?php elseif($item->jenis_fasilitas == 'parkir'): ?>
        <i class="fas fa-money-bill-wave text-xl">
        </i>
        <?php elseif($item->jenis_fasilitas == 'keamanan'): ?>
        <i class="fas fa-shield-alt text-xl">
        </i>
        <?php elseif($item->jenis_fasilitas == 'lokasi tenda'): ?>
        <i class="fas fa-campground text-xl">
        </i>
        <?php else: ?>
        <i class="fas fa-question-circle text-xl">
        <?php endif; ?>
        
        </i>
        <span>
         <?php echo e($item->deskripsi); ?>

        </span>
       </li>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       
      </ul>
     </div>
    </div>
    <div class="mt-6">
        <h2 class="text-2xl font-bold">
            Lokasi
        </h2>
        <div class="mt-4 p-4 bg-gray-100 rounded-lg">
            <div id="map-show" style="height: 400px;"></div>
        </div>
    </div>
    <div class="mt-6">
        <h1>4 hari perkiraan cuaca</h1>
        <div id="forecast" class="flex"></div>
    </div>
   </div>
  </div>

  <?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script>
    let latitude = <?php echo e($camp_ground->latitude ?? -7.250445); ?>;
    let longitude = <?php echo e($camp_ground->longitude ?? 112.768845); ?>;
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
        // Koordinat dari database
        let latitude = <?php echo e($camp_ground->latitude ?? -7.250445); ?>; // Default koordinat jika null
        let longitude = <?php echo e($camp_ground->longitude ?? 112.768845); ?>;
        console.log(latitude, longitude);
        // Inisialisasi peta
        const map = L.map('map-show').setView([latitude, longitude], 13);

        // Tambahkan tile layer
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Tambahkan marker
        L.marker([latitude, longitude]).addTo(map)
            .bindPopup('Lokasi')
            .openPopup();
    });
</script>


<script>
let latitude = <?php echo e($camp_ground->latitude ?? -7.250445); ?>;
let longitude = <?php echo e($camp_ground->longitude ?? 112.768845); ?>;
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
<?php /**PATH D:\rpl_final\camping\resources\views/detailcamp.blade.php ENDPATH**/ ?>