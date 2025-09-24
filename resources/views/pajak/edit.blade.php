@extends('layouts.master')
@section('content')

    @include('include.style')
    <!-- Breadcrumb Navigation -->
    @include('pajak.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('pajak.update', $row->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $row->userOne->nik ?? '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $row->userOne->name ?? '' }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Nama Pajak <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama"
                                value="{{ old('nama', $row->nama) }}" placeholder="Contoh : Pajak Tanah" required />
                        </div>
                        <div class="form-group">
                            <label>Total Bayar <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="total"
                                value="{{ old('total', $row->total) }}" placeholder="Contoh : 200000" required />
                        </div>
                        <div class="form-group">
                            <label>Keterangan <span class="text-danger">*</label>
                            <textarea class="form-control" name="keterangan" placeholder="Isi keterangan disini">{{ old('keterangan', $row->keterangan) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="0" {{ old('status', $row->status) == '0' ? 'selected' : '' }}>BELUM LUNAS</option>
                                <option value="1" {{ old('status', $row->status) == '1' ? 'selected' : '' }}>LUNAS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file" class="form-label">Upload Bukti Pelunasan</label>
                            <input type="file" name="file" id="file" class="form-control">
                            @if($row->file)
                                <a href="{{ asset('storage/' . $row->file) }}" target="_blank">Lihat Bukti Pelunasan</a>
                            @endif
                            @error('file')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('pajak.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>

    @include('include.script')
@endsection