@extends('layouts.master')
@section('content')

    @include('include.style')
    <!-- Breadcrumb Navigation -->
    @include('pajak.include.nav')
    <!-- End Breadcrumb Navigation -->
    <div class="card">
        <div class="card-header">
            <center><h4 class="card-title">{{ $title }}</h4></center>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Data Show -->
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">No. KTP</th>
                            <td>{{ $row->userOne->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $row->userOne->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Nama Pajak</th>
                            <td>{{ $row->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Total Terbayar</th>
                            <td>{{ rp($row->total) }}</td>
                        </tr>
                        <tr>
                            <th>Keterangan</th>
                            <td>{{ $row->keterangan ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge bg-success">LUNAS</span>
                                @else
                                    <span class="badge bg-primary">BELUM LUNAS</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Bukti Pelunasan</th>
                            <td>
                                @if($row->status == 1 && $row->file)
                                    <a href="{{ asset('storage/' . $row->file) }}" download target="_blank">Download Bukti Pelunasan</a>
                                @else
                                    <span class="text-danger">Tidak ada bukti pelunasan.</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tgl. Pembayaran</th>
                            <td>{{ format_date($row->date) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="{{ route('pajak.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
        </div>
    </div>

    @include('include.script')
@endsection