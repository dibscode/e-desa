@extends('layouts.master')
@section('content')
    {{ show_msg() }}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">DATA USER</h4>
                <div class="form-group mr-1 text-end d-flex gap-2">
                    <!-- Tombol Import -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="bi bi-upload"></i> Import
                    </button>
                    <!-- Tombol Tambah -->
                    <a class="btn btn-primary" href="{{ route('user.create') }}">
                        <i class="bi bi-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Avatar</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Jenis Kelamin</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $key => $row)
                        <tr>
                            <td>{{ $no++ }}</td>  
                            <td>
                                <div class="avatar-sm">
                                    @if(!empty($row->avatar) && file_exists(public_path('storage/'.$row->avatar)))
                                        <img src="{{ asset('storage/'.$row->avatar) }}" class="avatar-img rounded-circle shadow-sm" alt="" style="width:36px; height:36px; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('images/user.png') }}" class="avatar-img rounded-circle shadow-sm" alt="Default Avatar" style="width:36px; height:36px; object-fit:cover;">
                                    @endif
                                </div>
                            </td>
                            <td>{{ $row->username }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->gender == 2 ? "Perempuan" : "Laki-Laki" }}</td>
                            <td><span class="badge bg-success">{{ $row->level }}</span></td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('user.edit', $row) }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('user.destroy', $row) }}" method="POST" style="display: inline-block;"
                                    onsubmit="return confirm('Hapus Data?')">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i>
                                        Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Modal Import -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="{{ route('user.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
              </div>
              <div class="modal-body">
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File Excel</label>
                    <input type="file" class="form-control" name="file" id="file" accept=".xlsx,.xls,.csv" required>
                    <small class="text-muted">Format: xlsx, xls, csv</small>
                </div>
                <div class="mb-3">
                    <a href="{{ asset('template/template_import_user.xlsx') }}" class="btn btn-link">
                        <i class="bi bi-download"></i> Download Template Import
                    </a>
                </div>
                <div>
                    <small class="text-muted">
                        Semua data yang diimpor akan ditambahkan ke dalam database. Pastikan format file sesuai dengan template yang disediakan.
                    </small>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><i class="bi bi-upload"></i> Import</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
              </div>
            </div>
        </form>
      </div>
    </div>
@endsection