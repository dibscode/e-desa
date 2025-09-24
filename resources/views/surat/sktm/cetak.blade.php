@extends('layouts.print')
@section('content') 
<!-- header -->
@include('surat.kop.header')
<!-- end header -->
<!-- title -->
@include('surat.kop.title')
<!-- end title -->
<!-- content -->
@include('surat.sktm.include.content')
<!-- end content -->
<!-- footer -->
@if($row->status == 1)
@include('surat.kop.footer')
@endif
<!-- end footer -->
@endsection
