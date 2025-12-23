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

  <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-lg overflow-hidden">
   <div class="relative">
    <img alt="Sunset view at Pantai Air Manis" class="w-full h-64 object-cover" height="300" src="<?php echo e(asset('storage/' . $tip->image)); ?>" width="800"/>

   </div>
   

    <div class="mt-6">
     <h2 class="text-2xl font-bold">
      <?php echo e($tip->nama); ?>

     </h2>
     <div class="mt-4 p-4 bg-gray-100 rounded-lg">
      <ul class="space-y-2">
      <?php echo $tip->deskripsi; ?>

      
       
      </ul>
     </div>
    </div>
   </div>
  </div>

  <?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 </body>
</html>
<?php /**PATH D:\rpl_final\camping\resources\views/tipdetail.blade.php ENDPATH**/ ?>