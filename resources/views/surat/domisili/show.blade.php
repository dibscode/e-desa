@extends('layouts.master')
@section('content')

    @include('include.style')
    <!-- Breadcrumb Navigation -->
    @include('surat.domisili.include.nav')
    <!-- End Breadcrumb Navigation -->
    <div class="card">
        <div class="card-header">
            <center><h4 class="card-title">{{ $title }}</h4></center>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Data Show -->
                <div class="col-md-7">
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
                            <th>No. Surat</th>
                            <td>{{ $row->no_surat }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($row->status == 1)
                                    <span class="badge bg-success">SELESAI</span>
                                @elseif($row->status == 2)
                                    <span class="badge bg-danger">DITOLAK</span>
                                @else
                                    <span class="badge bg-primary">PENGAJUAN</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tgl. Pengajuan</th>
                            <td>{{ format_date($row->date) }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="col-md-5">
                    <table class="table table-bordered">
                        <tr>
                            <th width="40%">Silahkan Cek Preview Surat Sebelum Disetujui :</th>
                        </tr>
                        <tr>
                            <th>
                                <div class="btn-group float-end" role="group" aria-label="Basic example">
                                    @if($row->status == 1)
                                    <a class="btn btn-success btn-sm disabled" tabindex="-1" role="button" aria-disabled="true" href="{{ route('surat_domisili.signature', $row) }}"><i class="bi bi-pen"></i> Signature Kades</a>
                                    @else
                                    <a class="btn btn-success btn-sm" href="{{ route('surat_domisili.signature', $row) }}"><i class="bi bi-pen"></i> Signature Kades</a> 
                                    @endif
                                </div>
                            </th>
                        </tr>
                    </table>
                    <span class="text-danger">*Tombol signature kades tidak dapat di klik jika status surat sudah selesai.</span>
                </div>
                <!-- Garis Pembatas -->
                <!--<div class="col-md-1 d-flex justify-content-center align-items-center">
                    <div style="border-left:2px solid #ddd; height:100%;"></div>
                </div>-->
                <!-- Preview Surat -->
                <div class="col-md-12">
                    <div class="d-flex justify-content-end mb-2">
                        <a href="{{ route('surat_domisili.cetak', $row->id) }}" target="_blank" class="btn-sm btn btn-secondary">
                            <i class="bi bi-printer"></i> Print
                        </a>
                    </div>
                    <div class="border rounded p-3">
                        <!-- title -->
                        <div style="font-family: 'Times New Roman', serif;text-align: center; margin-top: 20px;margin-bottom: 20px">
                            <h2 style="margin: 0; font-size: 17px;border-bottom: 1.8px solid; display: inline-block;font-weight: bold">
                                {{ $previewTitle }}
                            </h2>
                            <p style="margin: 5px 0 0 0; font-size: 16px;">NOMOR : {{ $row->no_surat }}</p>
                        </div>
                        <!-- end title -->
                        <!-- content -->
                        @include('surat.domisili.include.content')
                        <!-- end content -->
                        <!-- footer -->
                        @if($row->status == 1)
                            @include('surat.kop.footer')
                        @endif
                        <!-- end footer -->
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-danger" href="{{ route('surat_domisili.index') }}"><i class="bi bi-box-arrow-in-left"></i> Kembali</a>
        </div>
    </div>

    @include('include.script')
@endsection