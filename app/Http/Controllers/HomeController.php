<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\SuratPengajuanSkck;
use App\Models\SuratKeteranganMiskin;
use App\Models\SuratKehilangan;
use App\Models\SuratKeteranganUsaha;
use App\Models\SuratDomisili;
use App\Models\SuratBedaNama;
use App\Models\SuratAhliwaris;
use App\Models\Pajak;
use App\Models\Produk;
use App\Models\Profile;
use App\Models\LogSurat;
use App\Models\Lapor;
use App\Models\KeuanganDesa;
use App\Models\User;

class HomeController extends Controller
{
    public function show()
    {
        $data['title'] = 'Hello, '.Auth::user()->name;

        // Ambil profil desa/perusahaan
        $data['company'] = Profile::first();

        // Hitung total surat masuk (jumlah semua jenis surat)
        $data['totalSuratSelesai'] =
            SuratAhliwaris::where('status', 1)->count() +
            SuratBedanama::where('status', 1)->count() +
            SuratDomisili::where('status', 1)->count() +
            SuratKehilangan::where('status', 1)->count() +
            SuratKeteranganUsaha::where('status', 1)->count() +
            SuratKeteranganMiskin::where('status', 1)->count() +
            SuratPengajuanSkck::where('status', 1)->count();

        $data['totalSuratPengajuan'] =
            SuratAhliwaris::where('status', 0)->count() +
            SuratBedanama::where('status', 0)->count() +
            SuratDomisili::where('status', 0)->count() +
            SuratKehilangan::where('status', 0)->count() +
            SuratKeteranganUsaha::where('status', 0)->count() +
            SuratKeteranganMiskin::where('status', 0)->count() +
            SuratPengajuanSkck::where('status', 0)->count();

        // Hitung total pajak
        $data['totalPajakBayar'] = Pajak::where('status', 1)->count();
        $data['totalPajakBelumBayar'] = Pajak::where('status', 0)->count();

        // Hitung total produk
        $data['totalProduk'] = Produk::count();

        // Statistik surat per bulan (Selesai)
        $bulan = [];
        $suratSelesaiPerBulan = [];
        $suratPengajuanPerBulan = [];
        $pajakBayarPerBulan = [];
        $pajakBelumBayarPerBulan = [];

        for ($i = 1; $i <= 12; $i++) {
            $bulan[] = date('F', mktime(0, 0, 0, $i, 10)); // Nama bulan Inggris

            // Surat Selesai
            $suratSelesaiPerBulan[] =
                SuratAhliwaris::whereMonth('created_at', $i)->where('status', 1)->count() +
                SuratBedanama::whereMonth('created_at', $i)->where('status', 1)->count() +
                SuratDomisili::whereMonth('created_at', $i)->where('status', 1)->count() +
                SuratKehilangan::whereMonth('created_at', $i)->where('status', 1)->count() +
                SuratKeteranganUsaha::whereMonth('created_at', $i)->where('status', 1)->count() +
                SuratKeteranganMiskin::whereMonth('created_at', $i)->where('status', 1)->count() +
                SuratPengajuanSkck::whereMonth('created_at', $i)->where('status', 1)->count();

            // Surat Pengajuan
            $suratPengajuanPerBulan[] =
                SuratAhliwaris::whereMonth('created_at', $i)->where('status', 0)->count() +
                SuratBedanama::whereMonth('created_at', $i)->where('status', 0)->count() +
                SuratDomisili::whereMonth('created_at', $i)->where('status', 0)->count() +
                SuratKehilangan::whereMonth('created_at', $i)->where('status', 0)->count() +
                SuratKeteranganUsaha::whereMonth('created_at', $i)->where('status', 0)->count() +
                SuratKeteranganMiskin::whereMonth('created_at', $i)->where('status', 0)->count() +
                SuratPengajuanSkck::whereMonth('created_at', $i)->where('status', 0)->count();

            // Pajak Lunas
            $pajakBayarPerBulan[] = Pajak::whereMonth('created_at', $i)->where('status', 1)->count();

            // Pajak Belum Lunas
            $pajakBelumBayarPerBulan[] = Pajak::whereMonth('created_at', $i)->where('status', 0)->count();
        }

        $data['bulan'] = $bulan;
        $data['suratSelesaiPerBulan'] = $suratSelesaiPerBulan;
        $data['suratPengajuanPerBulan'] = $suratPengajuanPerBulan;
        $data['pajakBayarPerBulan'] = $pajakBayarPerBulan;
        $data['pajakBelumBayarPerBulan'] = $pajakBelumBayarPerBulan;

        $data['logs'] = LogSurat::orderBy('id', 'desc')->paginate(10);

    // Lapor statistics
    $data['lapor_belum'] = Lapor::where('status', 'belum')->count();
    $data['lapor_proses'] = Lapor::where('status', 'proses')->count();
    $data['lapor_selesai'] = Lapor::where('status', 'selesai')->count();

    // Keuangan totals
    $data['keuangan_total_masuk'] = KeuanganDesa::sum('pemasukan');
    $data['keuangan_total_keluar'] = KeuanganDesa::sum('pengeluaran');

    // Total users
    $data['total_users'] = User::count();

        return view('home', $data);
    }

    public function message()
    {
        $data['title'] = 'Informasi';
        return view('message', $data);
    }
}
