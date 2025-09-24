<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapor - E-Desa</title>
     <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/x-icon">
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    @include('include.navbar')

    <div class="max-w-screen-xl mx-auto px-4 py-10">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2" data-aos="fade-up">Lapor - Pengaduan Masyarakat</h1>
                <p class="text-gray-600 dark:text-gray-400" data-aos="fade-up" data-aos-delay="100">Lihat laporan masyarakat. Tambahkan laporan baru lewat tombol "Tambah Laporan".</p>
            </div>
            <div>
                <button data-modal-target="laporModal" data-modal-toggle="laporModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Tambah Laporan</button>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($rows as $lapor)
            <div class="bg-white rounded-xl shadow-lg flex flex-col border border-gray-100 dark:bg-gray-800 dark:border-gray-700 overflow-hidden transition-transform hover:shadow-2xl group">
                @if($lapor->foto_url)
                    <div class="overflow-hidden">
                        <img src="{{ $lapor->foto_url }}" alt="Foto Lapor" class="w-full h-44 object-cover object-center mb-0">
                    </div>
                @else
                    <div class="w-full h-44 flex items-center justify-center bg-gray-100 text-gray-400">
                        <svg class="w-16 h-16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V7"/><path d="M16 3v4H8V3"/><path d="M3 7h18"/></svg>
                    </div>
                @endif
                <div class="flex-1 flex flex-col p-5">
                    <h3 class="text-lg font-bold mb-1 text-gray-900 dark:text-white text-left line-clamp-3 min-h-[48px]">{{ Str::limit($lapor->nama_lengkap, 60) }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3 line-clamp-3">{{ Str::limit($lapor->deskripsi, 120) }}</p>
                    <div class="mt-auto flex items-center justify-between">
                        <span class="text-xs font-semibold px-2 py-1 rounded {{ $lapor->status == 'selesai' ? 'bg-green-100 text-green-700' : ($lapor->status == 'proses' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700') }}">{{ ucfirst($lapor->status) }}</span>
                        <a href="{{ route('lapor.show', $lapor) }}" class="inline-block px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded hover:bg-blue-700">Lihat</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">Belum ada laporan.</div>
            @endforelse
        </div>

        <div class="mt-8">{{ $rows->links() }}</div>
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

    <!-- Modal -->
    <div id="laporModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
      <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-hide="laporModal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            <span class="sr-only">Close modal</span>
          </button>
          <div class="px-6 py-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Tambah Laporan</h3>
            <form class="space-y-6" action="{{ route('lapor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Foto (opsional)</label>
                    <input type="file" name="foto" class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-white focus:outline-none">
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Nomor WA</label>
                    <input type="text" name="nomor_wa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                </div>
                <div class="flex items-center justify-end">
                    <button data-modal-hide="laporModal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm px-5 py-2.5">Batal</button>
                    <button type="submit" class="ml-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">Kirim</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>