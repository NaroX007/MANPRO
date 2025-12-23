<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Tempat Camping
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
 </head>
 <body class="bg-gray-100">
<?php echo $__env->make('ui.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="bg-white shadow-md">
   <div class="container mx-auto px-4 py-4 mt-4 flex items-center justify-between">
    <div class="text-sm text-gray-600">
     <a class="hover:underline" href="#">
      Homepage
     </a>
     &gt; Tempat Camping
    </div>
   </div>
  </div>
  <div class="bg-blue-900 py-4">
   <div class="container mx-auto px-4 flex items-center justify-between">
    <div class="flex items-center bg-white rounded-md overflow-hidden">
     <button class="px-4 py-2 text-white">
      <i class="fas fa-search text-gray-300">
      </i>
     </button>
     <input class="px-4 py-2 w-full text-gray-700 focus:outline-none" placeholder="Cari" type="text"/>
    </div>
    <form class="bg-orange-400 text-white px-4 py-2 rounded-md flex items-center" action="<?php echo e(route('kategori')); ?>" method="GET">
    <input type="hidden" name="latitude" class="latitude">
    <input type="hidden" name="longitude" class="longitude">
    <select class="text-black" name="kategori">
        <option class="text-black" value="">Semua</option>
        <option class="text-black" value="Gunung">Gunung</option>
        <option class="text-black" value="Pantai">Pantai</option>
        <option class="text-black" value="Danau">Danau</option>
    </select>
    <button type="submit" class="">Pilih Kategori</button>
</form>

   </div>
  </div>
  
  <div class="container mx-auto px-4 py-6">

    <?php $__currentLoopData = $camp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
    $alamat = $cam->alamat;
    $pattern = "/Jl\..+?, ([^,]+), Kec\. ([^,]+), Kota ([^,]+), (.+)/";
    preg_match($pattern, $alamat, $matches);

    // Menyimpan hasil ke variabel
    $desa = $matches[1] ?? null;      // 'Lubuk Lintah'
    $kec = $matches[2] ?? null;       // 'Kuranji'
    $kota = $matches[3] ?? null;      // 'Padang'
    $provinsi = $matches[4] ?? null;
    ?>
    
   <div class="bg-white shadow-md rounded-md overflow-hidden mb-6">
    <div class="flex items-center">
     <div class="w-1/4 p-4">
      <img alt="Image of Mandalawangi Camping Ground" class="w-full h-full object-cover" height="100" src="<?php echo e(asset('storage/' . $cam->image)); ?>" width="100"/>
     </div>
     <div class="w-3/4 p-4">
      <h2 class="text-xl font-bold mb-2">
       <?php echo e($cam->nama); ?>

      </h2>
      <div class="text-gray-700 mb-4">
       <?php echo Str::limit($cam->deskripsi, 40); ?>

       <br/>
       Desa/Kelurahan : <?php echo e($desa); ?>

       <br/>
       Kecamatan : <?php echo e($kec); ?>

</div>
<a href="<?php echo e(route ('detailcamp', $cam->id)); ?>">
    <button class="bg-orange-400 text-white px-4 py-2 rounded-md">Selengkapnya
    </button></a>
     </div>
    </div>
    <div class="bg-orange-400 text-white text-sm px-4 py-2">
     <?php echo e($kota); ?> -<?php echo e($provinsi); ?>

    </div>
   </div>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


   

  </div>
  <?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  
 </body>
</html>
<?php /**PATH C:\xampp\htdocs\camping\resources\views/loc.blade.php ENDPATH**/ ?>