<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

        <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
        <!-- Quill JS -->
        <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>




        <script>
    // Inisialisasi Quill
    var quill = new Quill('#editor', {
        theme: 'snow', // Tema editor
        placeholder: 'Type your deskripsi here...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'], // Tombol teks
                ['blockquote', 'code-block'],             // Tombol blok
                [{ 'header': 1 }, { 'header': 2 }],       // Header
                [{ 'list': 'ordered' }, { 'list': 'bullet' }], // List
                [{ 'indent': '-1' }, { 'indent': '+1' }], // Indentasi
                [{ 'direction': 'rtl' }],                // Arah teks
                [{ 'size': ['small', false, 'large', 'huge'] }], // Ukuran teks
                [{ 'color': [] }, { 'background': [] }], // Warna
                [{ 'align': [] }],                      // Perataan teks
                ['link', 'image'],                      // Tautan dan gambar
                ['clean']                               // Bersihkan format
            ]
        }
    });
    let deskripsi = document.getElementById('deskripsi').value;
    if (deskripsi) {
        quill.root.innerHTML = deskripsi;
    }

    // Sinkronkan konten Quill dengan input hidden
    var deskripsiInput = document.getElementById('deskripsi');
    quill.on('text-change', function () {
        deskripsiInput.value = quill.root.innerHTML;
    });
</script>
    </body>
</html>
