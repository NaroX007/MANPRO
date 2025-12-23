<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Tips & Panduan Camping | SumbarCamp</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <?php echo $__env->make('ui.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mx-auto px-4 py-8 flex-grow">
        <nav class="text-sm text-gray-500 mb-6 flex items-center gap-2">
            <a class="hover:text-orange-500 transition" href="/">Homepage</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-gray-800 font-medium">Tips</span>
        </nav>

        <div class="bg-[#0E233E] text-white p-8 rounded-2xl shadow-lg mb-8 relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Tips & Panduan</h1>
                <p class="text-blue-100">Temukan tips menarik untuk pengalaman camping yang tak terlupakan.</p>
            </div>
            <i class="fas fa-lightbulb absolute right-[-20px] top-[-20px] text-white opacity-10 text-9xl rotate-12"></i>
        </div>

        <div class="space-y-6">
            <?php $__currentLoopData = $tip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white shadow-sm hover:shadow-md border border-gray-100 rounded-2xl overflow-hidden transition duration-300 group">
                <div class="flex flex-col md:flex-row">
                    <div class="md:w-1/3 h-52 md:h-auto overflow-hidden">
                        <img alt="<?php echo e($item->nama); ?>" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
                             src="<?php echo e(asset('storage/' . $item->image)); ?>"/>
                    </div>

                    <div class="p-6 md:w-2/3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-2">
                                <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Update Terbaru</span>
                                <span class="text-gray-400 text-xs"><?php echo e($item->created_at->diffForHumans()); ?></span>
                            </div>
                            <h2 class="text-2xl font-bold text-[#0E233E] mb-3 group-hover:text-blue-700 transition">
                                <?php echo e($item->nama); ?>

                            </h2>
                            <p class="text-gray-600 line-clamp-2 mb-4">
                                <?php echo e(strip_tags($item->deskripsi)); ?>

                            </p>
                        </div>

                        <div>
                            <a href="<?php echo e(route('detailtip', $item->id)); ?>" 
                               class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white font-semibold px-6 py-2.5 rounded-xl transition shadow-sm hover:shadow-orange-200">
                                Baca Selengkapnya
                                <i class="fas fa-arrow-right ml-2 text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-10">
            <?php echo e($tip->links()); ?>

        </div>
    </div>

    <?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\camping\resources\views/tips.blade.php ENDPATH**/ ?>