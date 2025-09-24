<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - E-Desa</title>
     <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/x-icon">
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    @include('include.navbar')
        
    <div class="max-w-screen-xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-2" data-aos="fade-up">Cara Menambahkan Produk</h1>
            <p class="text-center text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">Ikuti langkah-langkah berikut untuk menambahkan produk baru ke dalam sistem</p>
        </div>
        <div class="mb-8">
            <ol class="items-center sm:flex">
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Siapkan Data Produk</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Langkah 1</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Data Produk yang diperlukan adalah Nama, Foto, Harga dan Nomor WhatsApp.</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Kirim ke Admin Desa</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Langkah 2</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Hubungi admin desa secara online via WhatsApp maupun tatapmuka di balai desa untuk mengirim data produk.</p>
                    </div>
                </li>
                <li class="relative mb-6 sm:mb-0">
                    <div class="flex items-center">
                        <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-100 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-gray-900 shrink-0">
                            <svg class="w-2.5 h-2.5 text-blue-800 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                            </svg>
                        </div>
                        <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                    </div>
                    <div class="mt-3 sm:pe-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Produk Anda Siap di Tampilkan</h3>
                        <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Langkah 3</time>
                        <p class="text-base font-normal text-gray-500 dark:text-gray-400">Admin akan segera menambah data produk ke website E-Desa.</p>
                    </div>
                </li>
            </ol>
        </div>
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-2" data-aos="fade-up">Produk E-Desa</h1>
            <p class="text-center text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">Temukan produk lokal berkualitas dari E-Desa</p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
            @forelse($produks as $produk)
            <div class="bg-white rounded-xl shadow-lg p-6 flex flex-col items-center transition-transform hover:scale-105 hover:shadow-2xl border border-gray-100 dark:bg-gray-800 dark:border-gray-700">
                @if($produk->image)
                    <img src="{{ asset('storage/'.$produk->image) }}" alt="Gambar Produk" class="w-28 h-28 object-cover rounded-lg mb-4 shadow">
                @else
                    <div class="w-28 h-28 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7"/><path d="M16 3v4H8V3"/><path d="M3 7h18"/></svg>
                    </div>
                @endif
                <h3 class="text-lg font-bold mb-1 text-gray-900 dark:text-white text-center">{{ $produk->nama }}</h3>
                <div class="text-gray-300 font-bold mb-1 text-lg mb-2">Rp{{ number_format($produk->harga,0,',','.') }}</div>
                <div class="text-gray-700 text-center text-sm mb-2 dark:text-gray-300">
                    <a href="https://wa.me/{{ $produk->nomor_wa }}?text=Halo%20saya%20ingin%20memesan%20produk%20{{ urlencode($produk->nama) }}%20dengan%20harga%20Rp{{ number_format($produk->harga,0,',','.') }}" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow transition">Pesan</a>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada produk.</div>
            @endforelse
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

