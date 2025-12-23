<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title><?php echo e($artikel->nama); ?> | SumbarCamp</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }
        /* Menangani konten dari Text Editor (CKEditor/TinyMCE) */
        .content-area p { margin-bottom: 1.25rem; line-height: 1.8; color: #374151; }
        .content-area ul { list-style-type: disc; margin-left: 1.5rem; margin-bottom: 1.25rem; }
        .content-area ol { list-style-type: decimal; margin-left: 1.5rem; margin-bottom: 1.25rem; }
        .content-area h3 { font-size: 1.5rem; font-weight: 700; margin-top: 2rem; margin-bottom: 1rem; color: #111827; }
    </style>
</head>
<body class="flex flex-col min-h-screen">
    
    <?php echo $__env->make('ui.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="bg-white border-b">
        <div class="max-w-4xl mx-auto px-6 py-4 text-sm">
            <nav class="flex text-gray-500">
                <a href="/" class="hover:text-blue-600 transition">Beranda</a>
                <span class="mx-2 text-gray-300">/</span>
                <a href="<?php echo e(route('artikel')); ?>" class="hover:text-blue-600 transition">Artikel</a>
                <span class="mx-2 text-gray-300">/</span>
                <span class="text-gray-900 font-medium truncate"><?php echo e($artikel->nama); ?></span>
            </nav>
        </div>
    </div>

    <main class="flex-grow py-12 px-4">
        <article class="max-w-4xl mx-auto bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="relative h-64 md:h-[450px]">
                <img alt="<?php echo e($artikel->nama); ?>" 
                     class="w-full h-full object-cover" 
                     src="<?php echo e(asset('storage/' . $artikel->image)); ?>"/>
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                <div class="absolute bottom-0 left-0 p-6 md:p-10">
                    <h1 class="text-3xl md:text-5xl font-bold text-white leading-tight">
                        <?php echo e($artikel->nama); ?>

                    </h1>
                </div>
            </div>

            <div class="p-6 md:p-12">
                <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 mb-10 pb-6 border-b border-gray-50">
                    <div class="flex items-center">
                        <i class="far fa-calendar-alt mr-2 text-blue-600"></i>
                        <?php echo e($artikel->created_at->format('d F Y')); ?>

                    </div>
                    <div class="flex items-center">
                        <i class="far fa-clock mr-2 text-blue-600"></i>
                        5 Menit Baca
                    </div>
                    <div class="flex items-center">
                        <i class="far fa-user mr-2 text-blue-600"></i>
                        Redaksi SumbarCamp
                    </div>
                </div>

                <div class="content-area text-lg">
                    <?php echo $artikel->deskripsi; ?>

                </div>

                <div class="mt-16 pt-10 border-t border-gray-100 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-900 font-semibold">Bagikan ke:</span>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-green-100 text-green-600 hover:bg-green-600 hover:text-white transition">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                    <a href="<?php echo e(route('artikel')); ?>" class="group flex items-center text-blue-600 font-bold hover:text-blue-800 transition">
                        <i class="fas fa-long-arrow-alt-left mr-2 group-hover:-translate-x-1 transition-transform"></i>
                        Kembali ke Artikel
                    </a>
                </div>
            </div>
        </article>
    </main>

    <?php echo $__env->make('ui.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\camping\resources\views/detailartikel.blade.php ENDPATH**/ ?>