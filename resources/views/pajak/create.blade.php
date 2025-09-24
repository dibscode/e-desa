@extends('layouts.master')
@section('content')

    @include('include.style')
    
    <!-- Breadcrumb Navigation -->
    @include('pajak.include.nav')
    <!-- End Breadcrumb Navigation -->
    <form action="{{ route('pajak.index') }}" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="user_name" name="name" autocomplete="off" placeholder="Cari Berdasarkan NIK">
                            <input type="hidden" id="user_id" name="user_id" value="{{ old('user_id') }}">
                        </div>
                        <div class="form-group">
                            <label>Nama Pajak <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nama"
                                value="{{ old('nama') }}" placeholder="Contoh : Pajak Tanah"/>
                        </div>
                        <div class="form-group">
                            <label>Total Bayar <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="total"
                                value="{{ old('total') }}" placeholder="Contoh : 200000"/>
                        </div>
                        <div class="form-group">
                            <label>Keterangan <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="keterangan" value="{{ old('keterangan') }}" placeholder="Isi keterangan disini"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Status Pembayaran <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" required>
                                <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>BELUM LUNAS</option>
                                <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>LUNAS</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="file" class="form-label">Upload Bukti Pelunasan</label>
                            <input type="file" name="file" id="file" class="form-control">
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

    @include('include.autocomplete')
@endsection