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
    <?php echo $__env->make('ui.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="container mx-auto px-4 py-20 flex flex-col md:flex-row items-center justify-between" style="background-color:#0E233E">
   <div class="text-center md:text-left md:w-1/2 px-6">
    <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-50">
     Eksplor Alam Temukan Damai!
    </h1>
    <p class="text-lg md:text-xl mb-6 text-gray-50">
     Sumatera Barat: Surga untuk Pecinta Camping
    </p>
    <div class="relative">
     <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500">
     </i>
     <input class="w-full md:w-96 pl-12 pr-4 py-2 rounded-full text-gray-800" placeholder="Mau Camping Kemana" type="text"/>
    </div>
   </div>
   <div class="mt-10 md:mt-0 md:w-1/2 flex justify-center relative">
    <img alt="A scenic road winding through a forest with a camper van" height="300" src="https://s3-alpha-sig.figma.com/img/0356/82be/fcce2bc081cea96acfcf0440038d4439?Expires=1734912000&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4&Signature=SbdjXeMGnyQhoTIiCcN6isUZQcEd0nPevVlUNmPtw4ryytnu7WHAOqQryjGsQZiYO4NoLJ8q7bM0vgG4B9BI5JoK0I4ydSd0jkzUMN4TNH-Ve7ohqaLcl1OTkC78eczjWdJ-kPw2uhDWLDAVKd49oFWc6CvD0hInRK84VO6hnWDKsCBKCKOXuKTlbIqXJhVgUwTb6XqNJRLldHsXb3FRN5YHri0l3LMCPxAAbsriUGtn3WMZ0NFVDUCtETqCQXTJWT~HIOhwTxw3vyZYE3wN2hOTQ6wSfxX1OSedwi8D4oGTCor7e4dzEaNyl1BE7UJhoNfNvrDyyH9DN411mkRbuw__" width="300"/>
   </div>
  </div>
<div class="flex">
<img alt="SumbarCamp logo" class="mb-4 flex-1" height="100" src="<?php echo e(asset('img/image5.png')); ?>" width="100"/>
</div>

   <div class="mb-14 px-6">
   <h2 class="text-3xl font-bold mb-4 flex justify-center">
  <span class="text-red-600 mr-2">Rekomendasi </span>
  <span class="text-[#0E233E]"> Tempat Camping</span>
</h2>
  <div class="container mx-auto p-4">
   <div class="flex justify-end mb-4">
   <form action="<?php echo e(route('campground')); ?>" method="GET">
    <?php echo csrf_field(); ?>
    <input type="hidden" name="latitude" class="latitude">
    <input type="hidden" name="longitude" class="longitude">
    <button class="text-green-600" type="submit">Lihat Semua &gt;</button>
</form>

</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php $__currentLoopData = $camp; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route ('detailcamp', $cam->id)); ?>">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <?php if($cam->image): ?>
                <img class="w-full h-48 object-cover" src="<?php echo e(asset('storage/' . $cam->image)); ?>" alt="<?php echo e($cam->nama); ?>" height="400"  width="600">
                <?php else: ?>
                <img alt="Camping tents set up in a grassy area with people in the background" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/OKfX2n801VxgPqweOKyBNgRf48pmKvZbqGIrQquD5Zx6uA1nA.jpg" width="600"/>
                <?php endif; ?>
                <div class="p-4">
                    <h2 class="text-lg font-semibold">
                        <?php echo e($cam->nama); ?>

                    </h2>
                    <p class="text-gray-600">
                        <?php echo e($cam->alamat); ?>

                    </p>
                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


   </div>
  </div>
  <div class="container mx-auto px-4 py-8">
   <div class="flex justify-between items-center mb-8">
   <h1 class="text-3xl font-bold mb-4 flex justify-center">
  <span class="text-red-600 mr-2">Artikel </span>
  <span class="text-[#0E233E]"> Panduan</span>
</h1>
    <a class="text-sm text-green-600" href="<?php echo e(route('artikel')); ?>">
     Lihat Semua ›
    </a>
   </div>
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

   <?php $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(route ('detailartikel', $art->id)); ?>">
    <div class="flex items-start space-x-4">
     <img alt="Person holding a camping guidebook" class="w-24 h-24 rounded-lg object-cover" height="100" src="<?php echo e(asset ('storage/' . $art->image)); ?>" width="100"/>
     <div>
      <h2 class="text-lg font-semibold text-blue-800">
       <?php echo e($art->nama); ?>

      </h2>
      <p>
      <?php echo Str::limit(strip_tags($art->deskripsi), 224, '...'); ?> 
    </p>
     </div>
    </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    </div>
    <div class="container mx-auto px-4 py-8">
   <div class="flex justify-between items-center mb-8">
   <h1 class="text-3xl font-bold mb-4 flex justify-center">
  <span class="text-red-600 mr-2">Tips </span>
  <span class="text-[#0E233E]"> Panduan</span>
  
</h1>
    <a class="text-sm text-green-600" href="<?php echo e(route('tip')); ?>">
     Lihat Semua ›
    </a>
   </div>
   <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

   <?php $__currentLoopData = $tip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $art): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
   <a href="<?php echo e(route ('detailtip', $art->id)); ?>">
    <div class="flex items-start space-x-4">
     <img alt="Person holding a camping guidebook" class="w-24 h-24 rounded-lg object-cover" height="100" src="<?php echo e(asset ('storage/' . $art->image)); ?>" width="100"/>
     <div>
      <h2 class="text-lg font-semibold text-blue-800">
       <?php echo e($art->nama); ?>

      </h2>
      <p>
      <?php echo Str::limit(strip_tags($art->deskripsi), 224, '...'); ?>

    </p>
     </div>
    </div>
    </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



    

</div>
</div>
</div>
</div>

<?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<?php /**PATH D:\rpl_final\camping\resources\views/home.blade.php ENDPATH**/ ?>