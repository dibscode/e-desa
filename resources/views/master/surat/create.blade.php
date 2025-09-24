@extends('layouts.master')
@section('content')
    <form action="{{ route('surat.index') }}" method="POST">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Kode Surat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="kode"
                                value="{{ old('kode', kode_oto('kode', 'surat', 'S-', 3)) }}" />
                        </div>
                        <div class="form-group">
                            <label>Nama Surat <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name"
                                value="{{ old('name') }}" placeholder="Contoh : Surat Pengajuan Nikah"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('surat.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>
@endsection