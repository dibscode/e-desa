@extends('layouts.print')
@section('content') 
<!-- header -->
@include('surat.kop.header')
<!-- end header -->
<!-- title -->
@include('surat.kop.title')
<!-- end title -->
<!-- content -->
@include('surat.ahliwaris.include.content')
<!-- end content -->
<!-- footer -->
@if($row->status == 1)
@include('surat.kop.footer_camat')
@endif
<!-- end footer -->
@endsection
