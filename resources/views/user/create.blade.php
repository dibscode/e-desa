@extends('layouts.master')
@section('content')
    <form action="{{ route('user.index') }}" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Level <span class="text-danger">*</span></label>
                            <select class="form-control" name="level">
                                <option value="">-- Choose --</option>
                                <?= get_level_option(old('level')) ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Username <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="username"
                                value="{{ old('username') }}" placeholder="Contoh : zain"/>
                        </div>
                        <div class="form-group">
                            <label>Password <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="password"
                                value="{{ old('password') }}" placeholder="Contoh : zain"/>
                        </div>
                        <div class="form-group">
                            <label>NIK <span class="text-danger">*</span></label>
                            <input class="form-control" type="number" name="nik"
                                value="{{ old('nik') }}" placeholder="NIK Harus 16 Digit"/>
                        </div>
                        <div class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name"
                                value="{{ old('name') }}" placeholder="Contoh : Zainullah, S. Ag"/>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" name="email"
                                value="{{ old('email') }}" placeholder="Contoh : zain@gmail.com"/>
                        </div>
                        <div class="form-group">
                            <label>No. Telepon</label>
                            <input class="form-control" type="number" name="phone"
                                value="{{ old('phone') }}" placeholder="Contoh : 082228611625"/>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="form-control" name="gender">
                                <option value="">-- Choose --</option>
                                <?= get_jk_option(old('gender')) ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tempat Lahir</label>
                            <input class="form-control" type="text" name="birthplace"
                                value="{{ old('birthplace') }}" placeholder="Contoh : Situbondo"/>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <input class="form-control" type="date" name="birthdate"
                                value="{{ old('birthdate') }}"/>
                        </div>
                        <div class="form-group">
                            <label>RT/RW</label>
                            <input class="form-control" type="text" name="rtrw"
                                value="{{ old('rtrw') }}" placeholder="Contoh : 002/001"/>
                        </div>
                        
                        <div class="form-group">
                            <label>Kewarganegaraan</label>
                            <input class="form-control" type="text" name="kewarganegaraan"
                                value="{{ old('kewarganegaraan') }}" placeholder="Contoh : Indonesia"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Usia</label>
                            <input class="form-control" type="number" name="age"
                                value="{{ old('age') }}" placeholder="Contoh : 18"/>
                        </div>
                        <div class="form-group">
                            <label>Agama</span></label>
                            <input class="form-control" type="text" name="agama"
                                value="{{ old('agama') }}" placeholder="Contoh : Islam"/>
                        </div>
                        <div class="form-group">
                            <label>Alamat</span></label>
                            <input class="form-control" type="text" name="alamat"
                                value="{{ old('alamat') }}" placeholder="Contoh : Jl. Plaosa, RT.003 / RW.002"/>
                        </div>
                        <div class="form-group">
                            <label>Desa</span></label>
                            <input class="form-control" type="text" name="desa"
                                value="{{ old('desa') }}" placeholder="Contoh : Patokan"/>
                        </div>
                        <div class="form-group">
                            <label>Kecamatan</span></label>
                            <input class="form-control" type="text" name="kecamatan"
                                value="{{ old('kecamatan') }}" placeholder="Contoh : Patokan"/>
                        </div>
                        <div class="form-group">
                            <label>Kabupaten</span></label>
                            <input class="form-control" type="text" name="kabupaten"
                                value="{{ old('kabupaten') }}" placeholder="Contoh : Situbondo"/>
                        </div>
                        <div class="form-group">
                            <label>Provinsi</span></label>
                            <input class="form-control" type="text" name="provinsi"
                                value="{{ old('provinsi') }}" placeholder="Contoh : Jawa Timur"/>
                        </div>
                        <div class="form-group">
                            <label>Pekerjaan</span></label>
                            <input class="form-control" type="text" name="pekerjaan"
                                value="{{ old('pekerjaan') }}" placeholder="Contoh : Wiraswasta"/>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" name="status">
                                <option value="">-- Choose --</option>
                                <?= get_status_option(old('status')) ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>No.KK</span></label>
                            <input class="form-control" type="text" name="no_kk"
                                value="{{ old('no_kk') }}" placeholder="Contoh : Isi 16 Digit"/>
                        </div>
                        <div class="form-group">
                            <label>Pendidikan</span></label>
                            <input class="form-control" type="text" name="pendidikan"
                                value="{{ old('pendidikan') }}" placeholder="Contoh : S1"/>
                        </div>
                        <div class="form-group">
                            <label>Foto</span></label>
                            <input class="form-control" type="file" name="avatar"
                                value="{{ old('avatar') }}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                <a class="btn btn-danger" href="{{ route('user.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
            </div>
        </div>
    </form>
@endsection