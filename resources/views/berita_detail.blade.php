<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Tambahkan CDN CSS AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>E-Desa</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    @include('include.navbar') 

    <div class="max-w-screen-xl mx-auto px-4 py-10 gap-8 flex flex-col md:flex-row">
        <div class="flex-1 min-w-0">
            <div class="w-full bg-white rounded-xl shadow-lg p-6 mb-6 border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                <h1 class="text-2xl font-bold text-white">{{ $berita->judul }}</h1>
                <div class="text-xs text-blue-500 mb-4">Kategori: {{ $berita->kategori }}</div>
                <!-- Slider Gambar -->
                <div id="slider-berita" class="relative w-full mb-4">
                    <div class="relative aspect-[16/9] w-full overflow-hidden rounded-lg">
                        @php $imgs = array_filter([$berita->gambar1, $berita->gambar2, $berita->gambar3]); @endphp
                        @foreach($imgs as $i => $img)
                        <div class="slider-img absolute inset-0 transition-all duration-700 {{ $i === 0 ? 'opacity-100 z-10' : 'opacity-0 z-0' }}">
                            <img src="{{ asset('storage/'.$img) }}" class="w-full h-full object-cover rounded-lg" />
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Penulis & Tanggal Publish -->
                <div class="flex items-center gap-4 mb-4 text-gray-500 dark:text-gray-400 text-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-1 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>{{ $berita->penulis }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-1 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span>{{ $berita->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1 text-blue-500   " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ $berita->views ?? 0 }}</span>
                    </div>
                </div>
                <div class="prose max-w-none dark:prose-invert text-white">{!! nl2br(e($berita->isi)) !!}</div>
            </div>
        </div>
        <!-- Sidebar Berita Lainnya -->
        <div class="w-full md:w-80 md:flex-shrink-0">
            <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                <h3 class="text-lg font-bold mb-4 text-blue-500">Berita Lainnya</h3>
                <ul class="space-y-3">
                    @foreach($beritaLain as $b)
                    <li class="flex items-center space-x-2">
                        @if($b->gambar1)
                            <img src="{{ asset('storage/'.$b->gambar1) }}" class="w-12 h-12 object-cover rounded-md border border-gray-200 dark:border-gray-700" alt="{{ $b->judul }}" />
                        @endif
                        <div>
                            <a href="{{ route('berita.detail', $b->slug) }}" class="text-white hover:underline font-semibold">{{ $b->judul }}</a>
                            <div class="text-xs text-gray-400">{{ $b->kategori }}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" class="h-8" alt="E-Desa Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Desa</span>
                </a>
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">
                    © 2025 Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by 
                    <a href="https://dibscode.com/" class="text-blue-500">Adib Muhammad Zain</a>. All Rights Reserved.</span>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const slides = document.querySelectorAll('#slider-berita .slider-img');
        if (slides.length > 1) {
            let current = 0;
            let interval = null;
            function showSlide(idx) {
                slides.forEach((s, i) => {
                    s.classList.toggle('opacity-100', i === idx);
                    s.classList.toggle('z-10', i === idx);
                    s.classList.toggle('opacity-0', i !== idx);
                    s.classList.toggle('z-0', i !== idx);
                });
            }
            function startAutoSlide() {
                if(interval) clearInterval(interval);
                interval = setInterval(() => {
                    current = (current + 1) % slides.length;
                    showSlide(current);
                }, 3000);
            }
            showSlide(current);
            startAutoSlide();
        }
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</html>


