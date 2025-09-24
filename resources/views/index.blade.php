<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- Tambahkan CDN CSS AOS -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <title>E-Desa</title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/9/93/Lambang_Bondowoso.png" type="image/x-icon">
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen flex flex-col">
    @include('include.navbar')  

    <!-- Chat: hidden trigger, modal and JS -->
    <button id="open-chat-btn" type="button" class="hidden" aria-hidden="true"></button>

    <!-- Chat Modal -->
    <div id="chat-modal" class="fixed inset-0 z-50 hidden items-end sm:items-center justify-center px-4 py-6">
        <div id="chat-overlay" class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative w-full max-w-md mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden z-50">
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center">AI</div>
                    <div>
                        <div class="text-sm font-semibold text-gray-900 dark:text-white">Tanya AI Desa</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Tanyakan hal tentang layanan atau fasilitas desa</div>
                    </div>
                </div>
                <div>
                    <button id="close-chat-btn" class="text-gray-600 dark:text-gray-300 hover:text-gray-900">✕</button>
                </div>
            </div>

            <div id="chat-messages" class="h-64 overflow-y-auto px-4 py-3 space-y-3 bg-gray-50 dark:bg-gray-900">
                <!-- messages appended here -->
            </div>

            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
                <form id="chat-form" class="flex gap-2" onsubmit="return false;">
                    <input id="chat-input" type="text" placeholder="Ketik pertanyaan Anda tentang desa..." class="flex-1 rounded-md border border-gray-300 dark:border-gray-700 px-3 py-2 bg-white dark:bg-gray-800 text-sm text-gray-900 dark:text-gray-100" autocomplete="off" />
                    <button id="chat-send" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Kirim</button>
                </form>
            </div>
        </div>
    </div>

    <script>
    (function(){
        const openBtn = document.getElementById('open-chat-btn');
        const closeBtn = document.getElementById('close-chat-btn');
        const modal = document.getElementById('chat-modal');
        const overlay = document.getElementById('chat-overlay');
        const messagesEl = document.getElementById('chat-messages');
        const input = document.getElementById('chat-input');
        const sendBtn = document.getElementById('chat-send');

        function openModal(){
            modal.classList.remove('hidden');
            setTimeout(()=> modal.classList.add('flex'), 5);
            input.focus();
        }
        function closeModal(){
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        // If another element triggers a click on open-chat-btn (like the Konsultasi AI link), open modal
        openBtn.addEventListener('click', openModal);
        if(closeBtn) closeBtn.addEventListener('click', closeModal);
        if(overlay) overlay.addEventListener('click', closeModal);

        function appendMessage(text, who){
            const wrap = document.createElement('div');
            wrap.className = (who === 'user') ? 'text-right' : 'text-left';
            const bubble = document.createElement('div');
            bubble.className = (who === 'user') ? 'inline-block bg-blue-600 text-white px-3 py-2 rounded-lg' : 'inline-block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg';
            bubble.style.maxWidth = '80%';
            bubble.innerText = text;
            wrap.appendChild(bubble);
            messagesEl.appendChild(wrap);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }

        function showTyping(){
            const el = document.createElement('div');
            el.id = 'ai-typing';
            el.className = 'text-left';
            const bubble = document.createElement('div');
            bubble.className = 'inline-block bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 rounded-lg';
            bubble.innerText = 'AI sedang mengetik...';
            el.appendChild(bubble);
            messagesEl.appendChild(el);
            messagesEl.scrollTop = messagesEl.scrollHeight;
        }
        function removeTyping(){
            const t = document.getElementById('ai-typing');
            if(t) t.remove();
        }

        async function sendMessage(){
            const text = input.value.trim();
            if(!text) return;
            appendMessage(text, 'user');
            input.value = '';
            showTyping();

            // Try server endpoint first; if it fails, fall back to a simulated response.
            try{
                const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                const headers = {'Content-Type':'application/json'};
                if(tokenMeta){ headers['X-CSRF-TOKEN'] = tokenMeta.getAttribute('content'); }

                const res = await fetch('/api/bard-chat', {
                    method: 'POST',
                    headers,
                    body: JSON.stringify({ prompt: text })
                });

                if(res.ok){
                    const json = await res.json();
                    const answer = json.answer || 'Maaf, tidak ada jawaban dari AI.';
                    removeTyping();
                    appendMessage(answer, 'ai');
                    return;
                }
                // if not ok, throw to fallback
                throw new Error('Non-OK response');
            }catch(err){
                // fallback simulated reply
                setTimeout(()=>{
                    removeTyping();
                    const answer = 'Terima kasih, pertanyaan Anda: "' + text + '" telah diterima. (Jawaban placeholder — akan terhubung dengan Bard ketika API key ditambahkan.)';
                    appendMessage(answer, 'ai');
                }, 900);
            }
        }

        sendBtn.addEventListener('click', function(e){ e.preventDefault(); sendMessage(); });
        input.addEventListener('keydown', function(e){ if(e.key === 'Enter'){ e.preventDefault(); sendMessage(); } });
    })();
    </script>

    <!-- Bubble Play Button -->
    <audio id="myAudio" loop>
    <source src="{{ asset('storage/tech.mp3') }}" type="audio/mpeg">
    Your browser does not support the audio element.
    </audio>
    
    <style>
    .bubble-audio-btn {
        position: fixed;
        bottom: 32px;
        right: 32px;
        width: 60px;
        height: 60px;
        background: #4f8cff;
        color: #fff;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
        border: none;
        cursor: pointer;
        z-index: 9999;
        transition: background 0.2s;
    }
    .bubble-audio-btn:hover {
        background: #2563eb;
    }
    </style>
    
    <button class="bubble-audio-btn" id="audio-toggle-btn" type="button" title="Putar/Pause Musik">
        <span id="audio-icon">&#9835;</span>
    </button>
    
    <script>
    var x = document.getElementById("myAudio");
    var btn = document.getElementById("audio-toggle-btn");
    var icon = document.getElementById("audio-icon");
    
    btn.onclick = function() {
        if (x.paused) {
            x.play();
            icon.innerHTML = "&#10073;&#10073;"; // Pause icon
        } else {
            x.pause();
            icon.innerHTML = "&#9835;"; // Play icon
        }
    };
    
    x.onplay = function() { icon.innerHTML = "&#10073;&#10073;"; };
    x.onpause = function() { icon.innerHTML = "&#9835;"; };
    </script>


    <style>
    html, body {
        max-width: 100vw;
        overflow-x: hidden;
    }
    </style>
    <section class="relative bg-gray-700 bg-blend-multiply min-h-[350px] sm:min-h-[450px] md:min-h-[550px] lg:min-h-[650px] flex items-center dark:bg-gray-900 dark:bg-blend-multiply" data-aos="fade-down">
        <!-- Video sebagai background -->
        <div class="absolute inset-0 w-full h-full overflow-hidden pointer-events-none z-0 flex justify-center">
            <div class="relative w-full h-full max-w-full">
                <video
                    src="{{ asset('storage/loop.mp4') }}"
                    autoplay
                    muted
                    loop
                    playsinline
                    class="w-full h-full object-cover"
                    style="pointer-events: none;"
                ></video>
                <!-- Overlay gelap agar teks tetap terbaca -->
                <div class="absolute inset-0 bg-black opacity-60"></div>
            </div>
        </div>
        <div class="relative px-4 mx-auto max-w-screen-xl text-center py-24 lg:py-56 z-10 flex flex-col items-center justify-center w-full">
            <a data-aos="fade-down" href="{{ route('produk.frontend') }}" class="inline-flex justify-between items-center py-1 px-1 pe-4 mb-7 text-sm text-blue-700 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300 hover:bg-blue-200 dark:hover:bg-blue-800">
                <span data-aos="fade-down" class="text-xs bg-blue-600 rounded-full text-white px-4 py-1.5 me-3">New</span> <span class="text-sm font-medium">Produk lokal desa bisa dipasarkan disini</span> 
                <svg class="w-2.5 h-2.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
            </a>
            <h1 data-aos="fade-up" class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-white md:text-5xl lg:text-6xl">
                Kami Melayani Masyarakat <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">E-Desa</span>
            </h1>
            <p data-aos="fade-up" class="mb-8 text-lg font-normal text-gray-300 lg:text-xl sm:px-16 lg:px-48">
                Website Resmi E-Desa – Mewujudkan Pelayanan Publik yang Transparan, Cepat, dan Responsif untuk Masyarakat.
            </p>
            <div class="flex flex-col space-y-4 sm:flex-row sm:justify-center sm:space-y-0">
                <a data-aos="fade-right" href="#" id="btn-tutorial-surat" class="inline-flex justify-center items-center py-3 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Cara Mengajukan Surat
                    <svg style="width: 18px; padding-left: 6px; fill: white;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M0 64C0 28.7 28.7 0 64 0L224 0l0 128c0 17.7 14.3 32 32 32l128 0 0 288c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64zm384 64l-128 0L256 0 384 128z"/></svg>
                </a>
                <a data-aos="fade-left" href="{{ route('produk.frontend') }}" class="inline-flex justify-center text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center rounded-lg border border-white bg-gray-100 focus:ring-4 focus:ring-gray-400 hover:bg-gray-300">
                    Belanja Produk Desa 
                    <svg style="width: 20px; padding-left: 4px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M0 24C0 10.7 10.7 0 24 0L69.5 0c22 0 41.5 12.8 50.6 32l411 0c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3l-288.5 0 5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5L488 336c13.3 0 24 10.7 24 24s-10.7 24-24 24l-288.3 0c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5L24 48C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/></svg>
                </a>  
                <a data-aos="fade-left" href="{{ route('lapor.frontend') }}" class="inline-flex justify-center text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center rounded-lg border border-white bg-gray-100 focus:ring-4 focus:ring-gray-400 hover:bg-gray-300">
                    E-Lapor 
                    <svg style="width: 20px; padding-left: 4px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M213.1 128.8L202.7 160L128 160C92.7 160 64 188.7 64 224L64 480C64 515.3 92.7 544 128 544L512 544C547.3 544 576 515.3 576 480L576 224C576 188.7 547.3 160 512 160L437.3 160L426.9 128.8C420.4 109.2 402.1 96 381.4 96L258.6 96C237.9 96 219.6 109.2 213.1 128.8zM320 256C373 256 416 299 416 352C416 405 373 448 320 448C267 448 224 405 224 352C224 299 267 256 320 256z"/></svg>
                </a>  
                <a data-aos="fade-left" href="javascript:void(0)" onclick="document.getElementById('open-chat-btn').click()" class="inline-flex justify-center text-gray-900 items-center py-3 px-5 sm:ms-4 text-base font-medium text-center rounded-lg border border-white bg-gray-100 focus:ring-4 focus:ring-gray-400 hover:bg-gray-300">
                    Konsultasi AI
                    <svg style="width: 20px; padding-left: 4px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M576 304C576 436.5 461.4 544 320 544C282.9 544 247.7 536.6 215.9 523.3L97.5 574.1C88.1 578.1 77.3 575.8 70.4 568.3C63.5 560.8 62 549.8 66.8 540.8L115.6 448.6C83.2 408.3 64 358.3 64 304C64 171.5 178.6 64 320 64C461.4 64 576 171.5 576 304z"/></svg>
                </a>  
            </div>
             <!-- Popup Modal -->
            <div id="popup-tutorial-surat" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 dark:bg-opacity-70 dark:bg-gray-900 hidden">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full relative p-6">
                    <!-- Tombol Close -->
                    <h2 class="text-xl font-bold mb-4 text-blue-700 dark:text-blue-300">Tutorial Mengajukan Surat</h2>
                    <ol class="list-decimal list-inside space-y-2 text-gray-700 dark:text-gray-300">
                        <li>
                            Silakan datang ke Balai E-Desa pada jam kerja yang telah ditentukan.
                        </li>
                        <li>
                            Sampaikan permohonan pembuatan surat kepada operator desa yang bertugas.
                        </li>
                        <li>
                            Operator desa akan segera memproses dan membuatkan surat sesuai data dan informasi yang Anda berikan.
                        </li>       
                    </ol>
                    <div class="mt-6 flex justify-end">
                        <button id="close-popup-tutorial" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 transition">Tutup</button>
                    </div>
                </div>
            </div>
            <script>
                document.getElementById('btn-tutorial-surat').addEventListener('click', function(e) {
                    e.preventDefault();
                    document.getElementById('popup-tutorial-surat').classList.remove('hidden');
                });
                document.getElementById('close-popup-tutorial').onclick = function() {
                    document.getElementById('popup-tutorial-surat').classList.add('hidden');
                };
            </script>
        </div>
    </section>

    <div class="p-6 bg-gray-50 dark:bg-gray-900">
        <!-- Section Profil Desa -->
        <section class="bg-gray-50 dark:bg-gray-900 py-10" id="profil-desa">
            <div class="mx-auto mb-8 max-w text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Layanan Kami</h2>
                <p class="mb-4 text-gray-500 dark:text-gray-400">Berikut adalah Informasi Layanan E-Desa</p>
            </div>
            <div class="max-w-screen-xl mx-auto px-4 lg:px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <!-- Layanan Surat -->
                    <div data-aos="fade-right" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="mb-4">
                            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                                <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">Layanan</mark> <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Surat</span>
                            </h1>
                            <p class="mt-4 text-gray-700 dark:text-gray-300">
                                Layanan surat desa untuk berbagai keperluan administrasi masyarakat.
                            </p>
                        </div>
                        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Surat Meninggal Dunia</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Surat Keterangan Miskin</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Surat Keterangan Penghasilan</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Surat Pengantar Nikah</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Surat Pengantar SKCK</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengajuan Surat Pernyataan Penguasaan Tanah</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Layanan Laporan -->
                    <div data-aos="fade-up" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="mb-4">
                            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                                <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">Layanan</mark> <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Lapor</span>
                            </h1>
                            <p class="mt-4 text-gray-700 dark:text-gray-300">
                                Lapor masalah di desa secara cepat. Unggah foto dan jelaskan lokasi/kejadian untuk membantu penanganan.
                            </p>
                        </div>
                        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Laporkan Kerusakan Infrastruktur</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Laporan Kejadian Darurat</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pengaduan Pelayanan Publik</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Layanan Pajak -->
                    <div data-aos="fade-up" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="mb-4">
                            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                                <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">Layanan</mark> <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Pajak</span>
                            </h1>
                            <p class="mt-4 text-gray-700 dark:text-gray-300">
                                Kami menyediakan berbagai layanan untuk mendukung kebutuhan warga desa dengan cepat dan mudah.
                            </p>
                        </div>
                        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pembayaran Pajak Bumi & Bangunan</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Konsultasi Pajak Daerah</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Cetak SPPT & Bukti Bayar</span>
                            </li>
                        </ul>
                    </div>
                    <!-- Layanan Produk -->
                    <div data-aos="fade-up" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <div class="mb-4">
                            <h1 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                                <mark class="px-2 text-white bg-blue-600 rounded dark:bg-blue-500">Layanan</mark> <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Produk</span>
                            </h1>
                            <p class="mt-4 text-gray-700 dark:text-gray-300">
                                Temukan and pesan produk-produk unggulan hasil E-Desa secara langsung.
                            </p>
                        </div>
                        <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Produk Pangan & UMKM</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Pesan Produk via WhatsApp</span>
                            </li>
                            <li class="flex items-center space-x-3 rtl:space-x-reverse">
                                <svg class="flex-shrink-0 w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm4.707-9.707a1 1 0 00-1.414-1.414L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l5-5z" clip-rule="evenodd" />
                                </svg>
                                <span class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Lihat Katalog Produk</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Struktur Organisasi E-Desa dengan gaya Feature Section Flowbite -->
        <section id="struktur-organisasi" class="bg-white dark:bg-gray-900 py-12">
            <div class="max-w-screen-xl px-4 mx-auto lg:px-6">
                <div class="mx-auto mb-8 max-w text-center">
                    <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Struktur Organisasi E-Desa</h2>
                    <p class="mb-4 text-gray-500 dark:text-gray-400">Berikut adalah susunan perangkat E-Desa yang siap melayani masyarakat dengan profesional dan transparan.</p>
                </div>
                <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                            <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kepala Desa</h3>
                        <span class="text-gray-500 dark:text-gray-400">Wayan Hendriyono</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="100">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Sekretaris</h3>
                        <span class="text-gray-500 dark:text-gray-400">Hariyanto</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="200">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kaur Keuangan</h3>
                        <span class="text-gray-500 dark:text-gray-400">Umarul F.</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="300">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kaur Umum</h3>
                        <span class="text-gray-500 dark:text-gray-400">A. Baihaqi</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="400">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasi Pemerintahan</h3>
                        <span class="text-gray-500 dark:text-gray-400">Liasur</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="500">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasi Kesejahteraan</h3>
                        <span class="text-gray-500 dark:text-gray-400">Sahimo</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasi Pelayanan</h3>
                        <span class="text-gray-500 dark:text-gray-400">Indra Jaka S.</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasun</h3>
                        <span class="text-gray-500 dark:text-gray-400">Arsono</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasun</h3>
                        <span class="text-gray-500 dark:text-gray-400">Saiful B.</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasun</h3>
                        <span class="text-gray-500 dark:text-gray-400">Feri F.</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasun</h3>
                        <span class="text-gray-500 dark:text-gray-400">Sukidi</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasun</h3>
                        <span class="text-gray-500 dark:text-gray-400">Hendro P.</span>
                    </div>
                    <div class="flex flex-col items-center bg-gray-50 dark:bg-gray-800 rounded-lg p-6 shadow hover:shadow-lg transition" data-aos="fade-up" data-aos-delay="600">
                        <div class="mb-4 flex items-center justify-center w-20 h-20 rounded-full bg-blue-100 dark:bg-blue-900">
                        <img src="https://nkripost.com/wp-content/uploads/2024/12/Gaji-Kepala-desa-se-Indonesia.jpg" alt="Kepala Desa" class="object-cover w-full h-full rounded-full" />
                        </div>
                        <h3 class="mb-1 text-xl font-bold text-gray-900 dark:text-white">Kasun</h3>
                        <span class="text-gray-500 dark:text-gray-400">Fadhillah</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="statistik-desa" class="py-10 bg-gray-50 dark:bg-gray-900">
            <div class="mx-auto mb-8 max-w text-center">
                <h2 class="mb-4 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white">Statistik E-Desa</h2>
                <p class="mb-4 text-gray-500 dark:text-gray-400">Berikut adalah Statistik Informasi E-Desa.</p>
            </div>
            <div class="max-w-screen-xl mx-auto px-4 lg:px-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center">
                        <h5 class="my-4 text-lg font-semibold text-gray-900 dark:text-white text-center">Jumlah Penduduk Berdasarkan Jenis Kelamin</h4>
                        <!-- Tempatkan chart di sini -->
                            <div class="w-full h-32 flex flex-col items-center justify-center gap-2">
                                <canvas id="pieChartGender" width="120" height="120"></canvas>
                                <div class="flex flex-col items-center mt-2 text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full" style="background:#2563eb"></span>
                                        <span class="text-gray-700 dark:text-gray-200">Laki-laki: <b>1050</b></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full" style="background:#f59e42"></span>
                                        <span class="text-gray-700 dark:text-gray-200">Perempuan: <b>1046</b></span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="inline-block w-3 h-3 rounded-full bg-gray-400"></span>
                                        <span class="text-gray-700 dark:text-gray-200">Total: <b>2096</b></span>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center" data-aos="zoom-in" data-aos-delay="100">
                        <h4 class="my-4 text-lg font-semibold text-gray-900 dark:text-white text-center">Jumlah Penduduk Berdasarkan Usia</h4>
                        <!-- Tempatkan chart di sini -->
                        <div id="chart2" class="w-full h-32 flex flex-col items-center justify-center gap-2">
                            <canvas id="pieChartUsia" width="160" height="160"></canvas>
                            <div class="flex flex-col items-center mt-2 text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#2563eb"></span>
                                    <span class="text-gray-700 dark:text-gray-200">0–6: <b>218</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#3b82f6"></span>
                                    <span class="text-gray-700 dark:text-gray-200">7–15: <b>302</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#f59e42"></span>
                                    <span class="text-gray-700 dark:text-gray-200">16–18: <b>203</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#10b981"></span>
                                    <span class="text-gray-700 dark:text-gray-200">19–24: <b>187</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#fbbf24"></span>
                                    <span class="text-gray-700 dark:text-gray-200">25–39: <b>275</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#ef4444"></span>
                                    <span class="text-gray-700 dark:text-gray-200">40–49: <b>311</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#a78bfa"></span>
                                    <span class="text-gray-700 dark:text-gray-200">50–59: <b>245</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#6b7280"></span>
                                    <span class="text-gray-700 dark:text-gray-200">&gt;60: <b>355</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full bg-gray-400"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Total: <b>2.096</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center" data-aos="zoom-in" data-aos-delay="200">
                        <h4 class="my-4 text-lg font-semibold text-gray-900 dark:text-white text-center">Jumlah Penduduk Berdasarkan Mata Pencaharian</h4>
                        <!-- Tempatkan chart di sini -->
                        <div id="chart3" class="w-full h-32 flex flex-col items-center justify-center gap-2">
                            <canvas id="pieChartPekerjaan" width="160" height="160"></canvas>
                            <div class="flex flex-col items-center mt-2 text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#2563eb"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Petani: <b>742</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#f59e42"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Buruh tani: <b>290</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#10b981"></span>
                                    <span class="text-gray-700 dark:text-gray-200">PNS/TNI/POLRI: <b>8</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#f43f5e"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Karyawan swasta: <b>10</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#a21caf"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Pedagang: <b>98</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#fbbf24"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Wirausaha: <b>186</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#0ea5e9"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Pensiunan: <b>3</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#6366f1"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Tukang bangunan: <b>67</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#6b7280"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Peternak: <b>487</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full bg-gray-400"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Lain-lain/tidak tetap: <b>206</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full bg-gray-300"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Total: <b>2.096</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center" data-aos="zoom-in" data-aos-delay="300">
                        <h4 class="my-4 text-lg font-semibold text-gray-900 dark:text-white text-center">Jumlah tingkat rata-rata pendidikan </h4>
                        <!-- Tempatkan chart di sini -->
                        <div id="chart4" class="w-full h-32 flex flex-col items-center justify-center gap-2">
                            <canvas id="pieChartPendidikan" width="160" height="160"></canvas>
                            <div class="flex flex-col items-center mt-2 text-xs">
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#2563eb"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Belum Sekolah: <b>218</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#f59e42"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Tidak Tamat SD: <b>267</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#10b981"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Tamat SD: <b>974</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#f43f5e"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Tamat SLTP: <b>357</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#a21caf"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Tamat SLTA: <b>292</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#fbbf24"></span>
                                    <span class="text-gray-700 dark:text-gray-200">D1: <b>3</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#0ea5e9"></span>
                                    <span class="text-gray-700 dark:text-gray-200">D3: <b>6</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#6366f1"></span>
                                    <span class="text-gray-700 dark:text-gray-200">S1: <b>10</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full" style="background:#6b7280"></span>
                                    <span class="text-gray-700 dark:text-gray-200">S3: <b>1</b></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="inline-block w-3 h-3 rounded-full bg-gray-400"></span>
                                    <span class="text-gray-700 dark:text-gray-200">Total: <b>1.928</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
          </div>
        </section>

        <!-- Footer Start -->
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
    </div>

    <!-- Modal Tutorial Surat: tambahkan dark mode -->
    <div id="popup-tutorial-surat" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40 dark:bg-opacity-70 dark:bg-gray-900 hidden">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg max-w-md w-full relative p-6">
            <!-- Tombol Close -->
            <h2 class="text-xl font-bold mb-4 text-blue-700 dark:text-blue-300">Tutorial Mengajukan Surat</h2>
            <ol class="list-decimal list-inside space-y-2 text-gray-700 dark:text-gray-300">
                <li>
                    Silakan datang ke Balai E-Desa pada jam kerja yang telah ditentukan.
                </li>
                <li>
                    Sampaikan permohonan pembuatan surat kepada operator desa yang bertugas.
                </li>
                <li>
                    Operator desa akan segera memproses dan membuatkan surat sesuai data dan informasi yang Anda berikan.
                </li>       
            </ol>
            <div class="mt-6 flex justify-end">
                <button id="close-popup-tutorial" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 dark:bg-blue-700 dark:hover:bg-blue-800 transition">Tutup</button>
            </div>
        </div>
    </div>

    <!-- Tambahkan CDN JS AOS dan inisialisasi -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('pieChartGender').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
            labels: ['Laki-laki', 'Perempuan'],
            datasets: [{
                data: [1050, 1046],
                backgroundColor: ['#2563eb', '#f59e42'],
                borderWidth: 1
            }]
            },
            options: {
            responsive: false,
            plugins: {
                legend:
                {
                display: true,
                position: 'bottom'
                },
                tooltip: {
                callbacks: {
                    label: function(context) {
                    const label = context.label || '';
                    const value = context.raw || 0;
                    const percent = context.parsed !== undefined
                        ? ((value / 2096) * 100).toFixed(1)
                        : '';
                    return `${label}: ${value} (${percent}%)`;
                    }
                }
                }
            }
            }
        });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxUsia = document.getElementById('pieChartUsia').getContext('2d');
            new Chart(ctxUsia, {
                type: 'pie',
                data: {
                    labels: [
                        '0 – 6', '7 – 15', '16 – 18', '19 – 24',
                        '25 – 39', '40 – 49', '50 – 59', '>60'
                    ],
                    datasets: [{
                        data: [218, 302, 203, 187, 275, 311, 245, 355],
                        backgroundColor: [
                            '#2563eb', '#f59e42', '#10b981', '#f43f5e',
                            '#a21caf', '#fbbf24', '#0ea5e9', '#6366f1'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const percent = context.parsed !== undefined
                                        ? ((value / 2096) * 100).toFixed(2)
                                        : '';
                                    return `${label}: ${value} (${percent}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxPekerjaan = document.getElementById('pieChartPekerjaan').getContext('2d');
            new Chart(ctxPekerjaan, {
                type: 'pie',
                data: {
                    labels: [
                        'Petani', 'Buruh tani', 'PNS/TNI/POLRI', 'Karyawan swasta',
                        'Pedagang', 'Wirausaha', 'Pensiunan', 'Tukang bangunan',
                        'Peternak', 'Lain-lain/tidak tetap'
                    ],
                    datasets: [{
                        data: [742, 290, 8, 10, 98, 186, 3, 67, 487, 206],
                        backgroundColor: [
                            '#2563eb', '#f59e42', '#10b981', '#f43f5e',
                            '#a21caf', '#fbbf24', '#0ea5e9', '#6366f1',
                            '#6b7280', '#d1d5db'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const percent = context.parsed !== undefined
                                        ? ((value / 2096) * 100).toFixed(1)
                                        : '';
                                    return `${label}: ${value} (${percent}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctxPendidikan = document.getElementById('pieChartPendidikan').getContext('2d');
            new Chart(ctxPendidikan, {
                type: 'pie',
                data: {
                    labels: [
                        'Belum Sekolah', 'Tidak Tamat SD', 'Tamat SD', 'Tamat SLTP',
                        'Tamat SLTA', 'D1', 'D3', 'S1', 'S3'
                    ],
                    datasets: [{
                        data: [218, 267, 974, 357, 292, 3, 6, 10, 1],
                        backgroundColor: [
                            '#2563eb', '#f59e42', '#10b981', '#f43f5e',
                            '#a21caf', '#fbbf24', '#0ea5e9', '#6366f1', '#6b7280'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = 1928;
                                    const percent = context.parsed !== undefined
                                        ? ((value / total) * 100).toFixed(1)
                                        : '';
                                    return `${label}: ${value} (${percent}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>