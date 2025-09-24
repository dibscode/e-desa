@extends('layouts.master')
@section('content')
    <div class="container mt-4">
        <div class="card shadow">
            <div class="card-header bg-default text-black">
                <h4 class="mb-0 text-black text-center">Update Profile Desa</h4>
            </div>
            <form action="{{ route('profile.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-3 text-center">
                            <img src="{{ asset('images/logo_desa.jpg') }}" alt="Logo Desa" class="img-fluid rounded mb-3" style="max-width: 150px;">
                            <div class="form-group">
                                <label for="logo">Ganti Logo Desa</label>
                                <input type="file" class="form-control mt-2" name="logo" id="logo" accept="image/*">
                                @if($company->logo)
                                    <small class="text-muted d-block mt-1">Logo saat ini: {{ $company->logo }}</small>
                                @endif
                                @error('logo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group mb-2">
                                <label>Nama Desa</label>
                                <input type="text" class="form-control" name="desa" value="{{ old('desa', $company->desa) }}" required>
                                @error('desa')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Alamat</label>
                                <input type="text" class="form-control" name="alamat" value="{{ old('alamat', $company->alamat) }}" required>
                                @error('alamat')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $company->email) }}" required>
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Telepon</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone', $company->phone) }}">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>NPWP</label>
                                <input type="text" class="form-control" name="npwp" value="{{ old('npwp', $company->npwp) }}">
                                @error('npwp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group mb-2">
                                <label>Tentang Desa</label>
                                <textarea class="form-control" name="keterangan" rows="3">{{ old('keterangan', $company->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
@endsection