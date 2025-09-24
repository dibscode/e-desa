<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Desa</title>
     <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/x-icon">
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/png">
</head>

<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
      <!-- <nav class="bg-white border-gray-200 dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto p-4">
                <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse" data-aos="fade-right">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" class="h-8" alt="Flowbite Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Desa</span>
                </a>
                <div class="flex items-center md:order-2 space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <a href="{{ route('login') }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 md:px-5 md:py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" data-aos="fade-left">Login</a>
                    <button data-collapse-toggle="mega-menu-icons" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mega-menu-icons" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                </div>
                <div id="mega-menu-icons" class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1">
                    <ul class="flex flex-col mt-4 font-medium md:flex-row md:mt-0 md:space-x-8 rtl:space-x-reverse">
                        <li>
                            <a href="{{ route('index') }}" class="block py-2 px-3 text-blue-600 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-blue-500 md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700" aria-current="page" data-aos="fade-down">Home</a>
                        </li>
                        <li>
                            <a href="{{ route('produk.frontend') }}" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700" data-aos="fade-down">Produk</a>
                        </li>
                        <li>
                            <a href="{{ route('berita.frontend') }}" class="block py-2 px-3 text-gray-900 border-b border-gray-100 hover:bg-gray-50 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700" data-aos="fade-down">Berita</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
    <main class="flex flex-1 items-center justify-center py-8">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg flex flex-col md:flex-row overflow-hidden dark:bg-gray-800">
            <div class="w-full md:w-1/2 flex flex-col justify-center p-8">
                <div class="flex flex-col items-center mb-6">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('images/logo_desa.jpg') }}" alt="Logo" class="w-36 h-auto mb-2 rounded-lg shadow">
                    </a>
                    <h4 class="text-2xl font-bold text-gray-800 dark:text-white text-center mb-2">Log in. <span class="block text-sm font-normal text-gray-500">( APLIKASI DIGITAL E-Desa )</span></h4>
                </div>
                @if ($errors->any())
                    <div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li class="text-white">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('login.action') }}" method="POST" class="space-y-5">
                    {{ csrf_field() }}
                    <div>
                        <label for="username" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Username</label>
                        <div class="relative">
                            <input type="text" id="username" name="username" class="block w-full px-4 py-3 pl-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Username">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                        </div>
                    </div>
                    <div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-200">Password</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" class="block w-full px-4 py-3 pl-10 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" placeholder="Password">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.104 0 2-.896 2-2s-.896-2-2-2-2 .896-2 2 .896 2 2 2zm0 0v2m0 4h.01"/></svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input id="flexCheckDefault" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="flexCheckDefault" class="ml-2 text-sm text-gray-600 dark:text-gray-300">Keep me logged in</label>
                    </div>
                    <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base px-5 py-3 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 shadow">Log in</button>
                </form>
                <!--
                <div class="text-center mt-5 text-lg fs-4">
                    <p class="text-gray-600">Don't have an account? <a href="auth-register.html" class="font-bold">Sign up</a>.</p>
                    <p><a class="font-bold" href="auth-forgot-password.html">Forgot password?</a>.</p>
                </div>
                -->
            </div>
            <div class="hidden md:block md:w-1/2 bg-blue-50 dark:bg-gray-700">
                <div class="flex items-center justify-center h-full">
                    <img src="https://mir-s3-cdn-cf.behance.net/project_modules/fs/78c4af118001599.608076cf95739.jpg" alt="" srcset="" height="100%" class="object-cover w-full h-full rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </main>
    <!-- <footer class="bg-white rounded-lg shadow m-4 dark:bg-gray-900">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" class="h-8" alt="E-Desa Logo" />
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">E-Desa</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Beranda</a>
                    </li>
                    <li>
                        <a href="#profil-desa" class="hover:underline me-4 md:me-6">Profil</a>
                    </li>
                    <li>
                        <a href="#layanan" class="hover:underline me-4 md:me-6">Layanan</a>
                    </li>
                    <li>
                        <a href="#kontak" class="hover:underline">Kontak</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
            <span class="block text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2025 <a href="#" class="hover:underline">E-Desa</a>. All Rights Reserved.</span>
        </div>
    </footer> -->
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>
