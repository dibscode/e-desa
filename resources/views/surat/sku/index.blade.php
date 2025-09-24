@extends('layouts.master')
@section('content')
    {{ show_msg() }}
    <!-- Breadcrumb Navigation -->
    @include('surat.sku.include.nav')
    <!-- End Breadcrumb Navigation -->
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-cente">
                <h4 class="card-title">{{ $title }}</h4>
                <div class="form-group mr-1 text-end">
                    <a class="btn btn-primary" href="{{ route('surat_keterangan_usaha.create') }}">
                        <i class="bi bi-plus-lg"></i> TAMBAH</a>
                </div>
            </div>

            

            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Jenis Usaha</th>
                            <th>Lama Usaha</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $key => $row)
                        <tr>
                            <td>{{ $no++ }}</td>  
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->userOne->name }}</td>
                            <td>{{ $row->jenis_usaha }}</td>
                            <td>{{ $row->lama_usaha }}</td>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge bg-success">SELESAI</span>
                                @elseif($row->status == 2)
                                    <span class="badge bg-danger">DITOLAK</span>
                                @else
                                    <span class="badge bg-primary">PENGAJUAN</span>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="{{ route('surat_keterangan_usaha.show', $row) }}">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                @if($row->status == 1)
                                <a class="btn btn-sm btn-info disabled" tabindex="-1" role="button" aria-disabled="true" href="{{ route('surat_keterangan_usaha.edit', $row) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('surat_keterangan_usaha.destroy', $row) }}" method="POST" style="display: inline-block;"
                                    onsubmit="return confirm('Hapus Data?')">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger disabled" tabindex="-1" role="button" aria-disabled="true"><i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @else
                                
                                <a class="btn btn-sm btn-info" href="{{ route('surat_keterangan_usaha.edit', $row) }}">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="{{ route('surat_keterangan_usaha.destroy', $row) }}" method="POST" style="display: inline-block;"
                                    onsubmit="return confirm('Hapus Data?')">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection