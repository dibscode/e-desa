@extends('layouts.master')
@section('content')
    {{ show_msg() }}
    <section class="section">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-cente">
                <h4 class="card-title">Data Jenis Surat</h4>
                <div class="form-group mr-1 text-end">
                    <a class="btn btn-primary" href="{{ route('surat.create') }}">
                        <i class="bi bi-plus"></i> Tambah</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rows as $key => $row)
                        <tr>
                            <td>{{ $no++ }}</td>  
                            <td>{{ $row->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" href="{{ route('surat.edit', $row) }}">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('surat.destroy', $row) }}" method="POST" style="display: inline-block;"
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
@endsection