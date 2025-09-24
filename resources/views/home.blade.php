@extends('layouts.master')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center g-3">
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Total Surat</h5>
                    <div class="display-6">
                        <span class="text-danger">{{ $totalSuratPengajuan ?? 0 }}</span>
                        /
                        <span class="text-primary">{{ $totalSuratSelesai ?? 0 }}</span>
                    </div>
                    <div class="small text-muted dark:text-gray-400">Pengajuan / Selesai</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Total Pajak</h5>
                    <div class="display-6">
                        <span class="text-success">{{ $totalPajakBelumBayar ?? 0 }}</span>
                        /
                        <span class="text-warning">{{ $totalPajakBayar ?? 0 }}</span>
                    </div>
                    <div class="small text-muted dark:text-gray-400">Belum Lunas / Lunas</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Total Produk UMKM</h5>
                    <div class="display-6">{{ $totalProduk ?? 0 }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Lapor (Belum/Proses/Selesai)</h5>
                    <div class="display-6">
                        <span class="text-danger">{{ $lapor_belum ?? 0 }}</span>
                        /
                        <span class="text-warning">{{ $lapor_proses ?? 0 }}</span>
                        /
                        <span class="text-primary">{{ $lapor_selesai ?? 0 }}</span>
                    </div>
                    <div class="small text-muted dark:text-gray-400">Belum / Proses / Selesai</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    @php $user = Auth::user(); @endphp
                    @if(optional($user)->avatar && file_exists(public_path('storage/'.optional($user)->avatar)))
                        <img src="{{ asset('storage/'.optional($user)->avatar) }}" alt="Avatar" class="rounded-circle mb-2" style="width:48px; height:48px; object-fit:cover;">
                    @else
                        <img src="{{ asset('images/user.png') }}" alt="Avatar" class="rounded-circle mb-2" style="width:48px; height:48px; object-fit:cover;">
                    @endif
                    <div class="fw-bold text-gray-900 dark:text-white">{{ optional($user)->name ?? 'Pengunjung' }}</div>
                    <div class="text-muted dark:text-gray-400" style="font-size:13px;">{{ optional($user)->email ?? '-' }}</div>
                    <div class="badge bg-primary mt-1">{{ optional($user)->level ?? 'User' }}</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Total Users</h5>
                    <div class="display-6">{{ $total_users ?? 0 }}</div>
                    <div class="small text-muted dark:text-gray-400">Jumlah akun terdaftar</div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Keuangan - Pemasukan</h5>
                    <div class="display-6 text-success">{{ number_format($keuangan_total_masuk ?? 0, 2) }}</div>
                    <div class="small text-muted dark:text-gray-400">Total pemasukan</div>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6 col-md-3 mb-3">
            <div class="card text-center shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-body d-flex flex-column justify-content-center">
                    <h5 class="card-title text-gray-900 dark:text-white">Keuangan - Pengeluaran</h5>
                    <div class="display-6 text-danger">{{ number_format($keuangan_total_keluar ?? 0, 2) }}</div>
                    <div class="small text-muted dark:text-gray-400">Total pengeluaran</div>
                </div>
            </div>
        </div>
    </div>
    <!-- Statistik Bar Surat & Pajak + LogSurat -->
    <div class="row mt-4 g-3">
        <div class="col-12 col-lg-9">
            <div class="card shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-header bg-white dark:bg-gray-800 border-0 dark:border-b dark:border-gray-700">
                    <h5 class="mb-0 text-gray-900 dark:text-white">Statistik Surat & Pajak per Bulan</h5>
                </div>
                <div class="card-body">
                    <div id="statistik-bar" style="min-height: 340px;"></div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            <div class="card shadow h-100 bg-white dark:bg-gray-800 border-0 dark:border dark:border-gray-700">
                <div class="card-header bg-white dark:bg-gray-800 border-0 dark:border-b dark:border-gray-700">
                    <h6 class="mb-0 text-gray-900 dark:text-white">Log Surat Terbaru</h6>
                </div>
                <div class="card-body" style="max-height:340px; overflow-y:auto;">
                    <ul class="list-group list-group-flush">
                        @forelse($logs as $log)
                            <li class="list-group-item px-0 py-2 bg-transparent dark:bg-gray-900 border-0 dark:text-gray-200">
                                <div class="fw-bold">{{ format_datetime($log->waktu) ?? '-' }}</div>
                                <div class="small text-muted dark:text-gray-400">{{ $log->keterangan ?? '-' }}</div>
                            </li>
                        @empty
                            <li class="list-group-item text-muted text-center bg-transparent dark:bg-gray-900 dark:text-gray-400">Tidak ada log surat.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@include('include.statistik-bar')
@endsection
