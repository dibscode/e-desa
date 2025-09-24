@extends('layouts.master')
@section('title', $title ?? 'Detail Keuangan')
@section('content')
<div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Tanggal</dt>
            <dd class="col-sm-9">{{ $keuangan->tanggal->format('Y-m-d') }}</dd>

            <dt class="col-sm-3">Kode Rekening</dt>
            <dd class="col-sm-9">{{ $keuangan->kode_rekening }}</dd>

            <dt class="col-sm-3">Uraian</dt>
            <dd class="col-sm-9">{{ $keuangan->uraian }}</dd>

            <dt class="col-sm-3">Jenis</dt>
            <dd class="col-sm-9">{{ $keuangan->jenis_transaksi }}</dd>

            <dt class="col-sm-3">Pemasukan</dt>
            <dd class="col-sm-9">{{ number_format($keuangan->pemasukan,2) }}</dd>

            <dt class="col-sm-3">Pengeluaran</dt>
            <dd class="col-sm-9">{{ number_format($keuangan->pengeluaran,2) }}</dd>

            <dt class="col-sm-3">Sumber Dana</dt>
            <dd class="col-sm-9">{{ $keuangan->sumber_dana }}</dd>

            <dt class="col-sm-3">Keterangan</dt>
            <dd class="col-sm-9">{{ $keuangan->keterangan }}</dd>
        </dl>
    </div>
</div>
@endsection
