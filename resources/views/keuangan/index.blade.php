@extends('layouts.master')
@section('title', $title ?? 'Keuangan')
@section('content')
<div class="card">
    <div class="card-header">{{ $title }}</div>
    <div class="card-body">
        <a class="btn btn-primary mb-3" href="{{ route('keuangan.create') }}">Tambah</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Uraian</th>
                    <th>Jenis</th>
                    <th>Pemasukan</th>
                    <th>Pengeluaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $row)
                <tr>
                    <td>{{ $row->tanggal->format('Y-m-d') }}</td>
                    <td>{{ $row->kode_rekening }}</td>
                    <td>{{ $row->uraian }}</td>
                    <td>{{ $row->jenis_transaksi }}</td>
                    <td class="text-right">{{ number_format($row->pemasukan,2) }}</td>
                    <td class="text-right">{{ number_format($row->pengeluaran,2) }}</td>
                    <td>
                        <a class="btn btn-sm btn-info" href="{{ route('keuangan.show', $row) }}">Lihat</a>
                        <a class="btn btn-sm btn-warning" href="{{ route('keuangan.edit', $row) }}">Edit</a>
                        <form action="{{ route('keuangan.destroy', $row) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $rows->links() }}
    </div>
</div>
@endsection
