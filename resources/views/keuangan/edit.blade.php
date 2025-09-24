@extends('layouts.master')
@section('title', $title ?? 'Edit Keuangan')
@section('content')
<form action="{{ route('keuangan.update', $row) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-body">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', $row->tanggal->format('Y-m-d')) }}" required>
            </div>
            <div class="form-group">
                <label>Kode Rekening</label>
                <input type="text" name="kode_rekening" class="form-control" value="{{ old('kode_rekening', $row->kode_rekening) }}" required>
            </div>
            <div class="form-group">
                <label>Uraian</label>
                <input type="text" name="uraian" class="form-control" value="{{ old('uraian', $row->uraian) }}" required>
            </div>
            <div class="form-group">
                <label>Jenis Transaksi</label>
                <select name="jenis_transaksi" class="form-control">
                    <option value="Pemasukan" {{ old('jenis_transaksi', $row->jenis_transaksi) == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="Pengeluaran" {{ old('jenis_transaksi', $row->jenis_transaksi) == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Pemasukan</label>
                    <input type="number" step="0.01" name="pemasukan" class="form-control" value="{{ old('pemasukan', $row->pemasukan) }}">
                </div>
                <div class="form-group col-md-6">
                    <label>Pengeluaran</label>
                    <input type="number" step="0.01" name="pengeluaran" class="form-control" value="{{ old('pengeluaran', $row->pengeluaran) }}">
                </div>
            </div>
            <div class="form-group">
                <label>Sumber Dana</label>
                <input type="text" name="sumber_dana" class="form-control" value="{{ old('sumber_dana', $row->sumber_dana) }}">
            </div>
            <div class="form-group">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', $row->keterangan) }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Simpan</button>
            <a class="btn btn-danger" href="{{ route('keuangan.index') }}">Batal</a>
        </div>
    </div>
</form>
@endsection
