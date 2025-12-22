<html>
 <head>
  <title>
   Camping Grounds
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&amp;display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <style>
   body {
            font-family: 'Roboto', sans-serif;
        }
  </style>
 </head>
 <body class="bg-gray-100">
    @include('ui.navbar')
  <div class="container mx-auto px-4 py-20 flex flex-col md:flex-row items-center justify-between" style="background-color:#0E233E">
   <div class="text-center md:text-left md:w-1/2 px-6">
    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-50">
     Eksplor Alam Temukan Damai!
    </h1>
    <p class="text-lg md:text-xl mb-6 text-gray-50">
     Sumatera Barat: Surga untuk Pecinta Camping
    </p>
    <div class="relative">
        <form action="{{ route('campground') }}" method="GET">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
            
            <input 
                name="search" 
                value="{{ request('search') }}"
                class="w-full md:w-96 pl-12 pr-4 py-2 rounded-full text-gray-800 focus:outline-none" 
                placeholder="Mau Camping Kemana?" 
                type="text"
            />
            
            <button type="submit" class="hidden"></button>
        </form>
    </div>
   </div>
   <div class="mt-10 md:mt-0 md:w-1/2 flex justify-center relative">
    <img alt="home_image_1" height="300" src="{{ asset('storage/img/home_image_0.png') }}" width="300"/>
   </div>
  </div>
<div class="flex">
<img alt="SumbarCamp logo" class="mb-4 flex-1" height="100" src="{{ asset('img/image5.png') }}" width="100"/>
</div>

   <div class="mb-14 px-6">
   <h2 class="text-3xl font-bold mb-4 flex justify-center">
  <span class="text-red-600 mr-2">Rekomendasi </span>
  <span class="text-[#0E233E]"> Tempat Camping</span>
</h2>
  <div class="container mx-auto p-4">
   <div class="flex justify-end mb-4">
   <form action="{{ route('campground') }}" method="GET">
    @csrf
    <input type="hidden" name="latitude" class="latitude">
    <input type="hidden" name="longitude" class="longitude">
    <button class="text-green-600" type="submit">Lihat Semua &gt;</button>
</form>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($camp as $cam)
            <a href="{{ route ('detailcamp', $cam->id) }}">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if ($cam->image)
                <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $cam->image) }}" alt="{{ $cam->nama }}" height="400"  width="600">
                @else
                <img alt="Camping tents set up in a grassy area with people in the background" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/OKfX2n801VxgPqweOKyBNgRf48pmKvZbqGIrQquD5Zx6uA1nA.jpg" width="600"/>
                @endif
                <div class="p-4">
                    <h2 class="text-lg font-semibold">
                        {{ $cam->nama }}
                    </h2>
                    <p class="text-gray-600">
                        {{ $cam->alamat }}
                    </p>
                </div>
            </div>
        </a>
        @endforeach


   </div>
  </div>
  <div class="container mx-auto px-4 py-8">
   <div class="flex justify-between items-center mb-8">
   <h1 class="text-3xl font-bold mb-4 flex justify-center">
  <span class="text-red-600 mr-2">Artikel </span>
  <span class="text-[#0E233E]"> Panduan</span>
</h1>
    <a class="text-sm text-green-600" href="{{ route('artikel') }}">
     Lihat Semua ›
    </a>
   </div>
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

   @foreach($artikel as $art)
   <a href="{{ route ('detailartikel', $art->id) }}">
    <div class="flex items-start space-x-4">
     <img alt="Person holding a camping guidebook" class="w-24 h-24 rounded-lg object-cover" height="100" src="{{ asset ('storage/' . $art->image) }}" width="100"/>
     <div>
      <h2 class="text-lg font-semibold text-blue-800">
       {{ $art->nama }}
      </h2>
      <p>
      {!! Str::limit(strip_tags($art->deskripsi), 224, '...') !!} 
    </p>
     </div>
    </div>
    </a>
    @endforeach
    </div>
    </div>
    <div class="container mx-auto px-4 py-8">
   <div class="flex justify-between items-center mb-8">
   <h1 class="text-3xl font-bold mb-4 flex justify-center">
  <span class="text-red-600 mr-2">Tips </span>
  <span class="text-[#0E233E]"> Panduan</span>
  
</h1>
    <a class="text-sm text-green-600" href="{{ route('tip') }}">
     Lihat Semua ›
    </a>
   </div>
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

   @foreach($tip as $art)
   <a href="{{ route ('detailtip', $art->id) }}">
    <div class="flex items-start space-x-4">
     <img alt="Person holding a camping guidebook" class="w-24 h-24 rounded-lg object-cover" height="100" src="{{ asset ('storage/' . $art->image) }}" width="100"/>
     <div>
      <h2 class="text-lg font-semibold text-blue-800">
       {{ $art->nama }}
      </h2>
      <p>
      {!! Str::limit(strip_tags($art->deskripsi), 224, '...') !!}
    </p>
     </div>
    </div>
    </a>
    @endforeach



    

</div>
</div>
</div>
</div>

@include('ui.footer')


