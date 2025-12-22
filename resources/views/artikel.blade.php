<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Tips
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
    @include('ui.navbar')
  <div class="container mx-auto px-4 py-6">
   <nav class="text-sm text-gray-600 mb-4">
    <a class="hover:underline" href="#">
     Homepage
    </a>
    &gt;
    <span>
     Artikel
    </span>
   </nav>
   <div class="bg-blue-900 text-white p-4 rounded-t-lg flex justify-between items-center">
    <h1 class="text-2xl font-bold">
     Artikel
    </h1>
   </div>
   <div class="bg-white shadow-md rounded-b-lg">

@foreach($artikel as $item)
    <div class="p-4 flex flex-col md:flex-row border-b">
     <img alt="Beginner camping tips" class="w-full md:w-1/4 h-auto rounded-md" height="150" src="{{ asset('storage/' . $item->image) }}" width="150"/>
     <div class="md:ml-4 mt-4 md:mt-0">
      <h2 class="text-xl font-bold text-blue-900">
      {{ $item->nama }}
      </h2>
      {!! Str::limit(strip_tags($item->deskripsi), 100) !!}
      </br>
</br>
      <button class="bg-orange-400 text-white px-4 py-2 rounded-md mt-4">
       <a href="{{ route ('detailartikel' , $item->id)}}">Selengkapnya</a>
      </button>
     </div>
    </div>
    @endforeach

   </div>
   </div>
    @include('ui.footer')
 </body>
</html>
