<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   SumbarCamp
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  
 </head>
 <body class="bg-blue-900 text-white">
  <div class="flex flex-col md:flex-row h-screen">
   <div class="md:w-1/2 flex flex-col justify-up items-start p-10">
    <img alt="SumbarCamp logo" class="mb-4" height="100" src="{{ asset('img/image1.png') }}" width="100"/>
    <div class="border-l-4 border-white pl-4">
     <h1 class="px-4 text-4xl font-bold">
      SUMATERA
     </h1>
     <h1 class="px-4 text-5xl font-bold">
      BARAT
     </h1>
     <h2 class="px-4 text-4xl font-light mt-2">
      CAMP
     </h2>
    </div>
    <p class="py-10 px-6 mt-4 text-lg">
     Selamat datang di SumbarCamp, platform informasi camping di Sumatera Barat! Temukan lokasi terbaik untuk berkemah dengan mudah, lengkap dengan panduan, tips, dan rekomendasi untuk pengalaman camping yang tak terlupakan.
    </p>
    <form action="{{ route('home') }}" method="GET">
    @csrf
    <input type="hidden" name="latitude" id="latitude">
    <input type="hidden" name="longitude" id="longitude">
    <button class="mt-6 bg-teal-500 text-white py-2 px-4 rounded" type="submit">Jelajahi Sekarang</button>
</form>



   </div>
   <div class="md:w-1/2 relative">
    <img alt="Camping scene with a tent and a waterfall in the background" class="w-full h-full object-cover" height="600" src="{{ asset('img/image4.png') }}" width="800"/>
    <div class="absolute bottom-4 right-4 flex space-x-4 text-white">
     <a class="text-2xl" href="#">
      <i class="fab fa-facebook">
      </i>
     </a>
     <a class="text-2xl" href="#">
      <i class="fab fa-instagram">
      </i>
     </a>
     <a class="text-2xl" href="#">
      <i class="fab fa-twitter">
      </i>
     </a>
    </div>
   </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        navigator.geolocation.getCurrentPosition(function(position) {
            document.getElementById('latitude').value = position.coords.latitude;
            document.getElementById('longitude').value = position.coords.longitude;
        });
    });
</script>
 </body>
</html>
