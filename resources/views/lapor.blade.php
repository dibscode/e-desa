<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor - Desa Tarum</title>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    @include('include.navbar')

    <div class="max-w-screen-xl mx-auto px-4 py-10">
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-center text-gray-900 dark:text-white mb-2" data-aos="fade-up">Lapor - Aduan Masyarakat</h1>
            <p class="text-center text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">Sampaikan laporan atau aduan kepada pihak desa.</p>
        </div>

        <div class="text-right mb-6">
            <a href="{{ route('lapor.create') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Buat Laporan</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($rows as $lapor)
                <div class="bg-white rounded-lg shadow p-4 dark:bg-gray-800 dark:border-gray-700">
                    @if($lapor->foto)
                        <img src="{{ asset('storage/'.$lapor->foto) }}" alt="Foto" class="w-full h-40 object-cover rounded mb-3">
                    @endif
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ Str::limit($lapor->nama_lengkap, 50) }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">{{ Str::limit($lapor->deskripsi, 100) }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs px-2 py-1 rounded bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200">{{ ucfirst($lapor->status) }}</span>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center text-gray-500">Belum ada laporan.</div>
            @endforelse
        </div>

        <div class="mt-6">{{ $rows->links() }}</div>
    </div>

    <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" class="h-8" alt="E-Desa Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Desa Tarum</span>
                </a>
                <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 Desa Tarum</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>AOS.init();</script>
</body>
</html>
