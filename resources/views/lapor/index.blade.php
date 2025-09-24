@extends('layouts.master')

@section('content')
    {{ show_msg() }}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Data Lapor</h4>
                <a href="{{ route('admin.lapor.create') }}" class="btn btn-primary">Tambah Lapor</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Foto</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Nomor WA</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rows as $key => $row)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $row->nama_lengkap }}</td>
                                    <td>
                                        @if($row->foto && file_exists(public_path('storage/'.$row->foto)))
                                            <img src="{{ $row->foto_url }}" alt="Foto" style="max-width:80px;">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($row->deskripsi, 80) }}</td>
                                    <td><span class="badge bg-info">{{ ucfirst($row->status) }}</span></td>
                                    <td>{{ $row->nomor_wa }}</td>
                                    <td>
                                        <a href="{{ route('admin.lapor.show', $row) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('admin.lapor.edit', $row) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.lapor.destroy', $row) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Yakin hapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
