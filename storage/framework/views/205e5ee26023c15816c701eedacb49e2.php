<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo e($tip->nama); ?> | SumbarCamp</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        /* Memastikan konten dari CKEditor/TinyMCE tetap rapi */
        .article-content ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1rem; }
        .article-content ol { list-style-type: decimal; margin-left: 1.5rem; margin-bottom: 1rem; }
        .article-content p { margin-bottom: 1rem; line-height: 1.8; color: #4a5568; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    
    <?php echo $__env->make('ui.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <nav class="bg-white border-b">
        <div class="max-w-4xl mx-auto px-6 py-3 text-sm text-gray-600">
            <a href="/" class="hover:text-orange-500">Home</a> 
            <span class="mx-2">/</span> 
            <a href="<?php echo e(route('tip')); ?>" class="hover:text-orange-500">Tips</a> 
            <span class="mx-2">/</span> 
            <span class="text-gray-400"><?php echo e(Str::limit($tip->nama, 20)); ?></span>
        </div>
    </nav>

    <main class="flex-grow py-10 px-4">
        <article class="max-w-4xl mx-auto bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="relative h-[400px] overflow-hidden group">
                <img alt="<?php echo e($tip->nama); ?>" 
                     class="w-full h-full object-cover transition duration-500 group-hover:scale-105" 
                     src="<?php echo e(asset('storage/' . $tip->image)); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-8">
                    <span class="bg-orange-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wider mb-3 inline-block">
                        Tips & Trik
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold text-white leading-tight">
                        <?php echo e($tip->nama); ?>

                    </h1>
                </div>
            </div>

            <div class="p-8 md:p-12">
                <div class="flex items-center text-gray-500 text-sm mb-8 pb-8 border-b border-gray-100">
                    <div class="flex items-center mr-6">
                        <i class="far fa-calendar-alt mr-2 text-orange-500"></i>
                        <?php echo e($tip->created_at->format('d M Y')); ?>

                    </div>
                    <div class="flex items-center">
                        <i class="far fa-user mr-2 text-orange-500"></i>
                        Admin SumbarCamp
                    </div>
                </div>

                <div class="article-content text-lg">
                    <?php echo $tip->deskripsi; ?>

                </div>

                <div class="mt-12 pt-8 border-t border-gray-100 flex flex-wrap justify-between items-center gap-4">
                    <div class="flex space-x-4">
                        <span class="text-gray-500 font-medium">Bagikan:</span>
                        <a href="#" class="text-blue-600 hover:opacity-75"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-blue-400 hover:opacity-75"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-green-500 hover:opacity-75"><i class="fab fa-whatsapp"></i></a>
                    </div>
                    <a href="<?php echo e(route('tip')); ?>" class="inline-flex items-center text-orange-500 font-semibold hover:text-orange-600">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Tips
                    </a>
                </div>
            </div>
        </article>
    </main>

    <?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\camping\resources\views/tipdetail.blade.php ENDPATH**/ ?>