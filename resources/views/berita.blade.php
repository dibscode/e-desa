<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita - E-Desa</title>
     <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/x-icon">
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    @include('include.navbar')

    <div class="max-w-screen-xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-2" data-aos="fade-up">Berita E-Desa</h1>
            <p class="text-center text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">Berita terbaru dan informasi terkini seputar E-Desa.</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($beritas as $berita)
            <a href="{{ route('berita.detail', $berita->slug) }}" class="bg-white rounded-xl shadow-lg flex flex-col border border-gray-100 dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-transform hover:shadow-2xl group focus:outline-none focus:ring-2 focus:ring-blue-400">
                @if($berita->gambar1)
                    <div class="overflow-hidden">
                        <img src="{{ asset('storage/'.$berita->gambar1) }}" alt="Gambar Berita"
                            class="w-full h-44 object-cover object-center mb-0 transition-transform duration-300 group-hover:scale-110">
                    </div>
                @else
                    <div class="w-full h-44 flex items-center justify-center bg-blue-100 text-blue-400">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7"/><path d="M16 3v4H8V3"/><path d="M3 7h18"/></svg>
                    </div>
                @endif
                <div class="flex-1 flex flex-col p-5">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded">{{ $berita->kategori }}</span>
                    </div>
                    <h3 class="text-lg font-bold mb-1 text-gray-900 dark:text-white text-left line-clamp-2 min-h-[48px]">{{ $berita->judul }}</h3>
                    <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span>{{ $berita->views ?? 0 }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="inline-block px-4 py-2 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700 transition">Baca Selengkapnya</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada berita.</div>
            @endforelse
        </div>
        <div class="mt-8">{{ $beritas->links() }}</div>
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
                    <a href="https://dibscode.com" class="text-blue-500">Adib Muhammad Zain</a>. All Rights Reserved.</span>
                </div>
                <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>