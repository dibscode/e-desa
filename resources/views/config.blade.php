@extends('layouts.master')
@section('title', $title)
@section('content')
    {{ show_msg() }}
    <form action="{{ route('config.update') }}" method="POST" enctype="multipart/form-data">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        {{ show_error($errors) }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Judul <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="judul"
                                value="{{ old('judul', $row->judul) }}" />
                        </div>
                        <div class="form-group">
                            <label>Logo <span class="text-danger">*</span></label>
                            <input class="form-control" type="file" name="logo" />
                            <p class="form-text">
                                <img src="{{ $row->image() }}" height="100" />
                            </p>
                        </div>
                        <div class="form-group">
                            <label>Pilih Kamera <span class="text-danger">*</span></label>
                            <select class="form-control" name="kamera" onchange="changeCamera()">
                                <option value="{{ $row->kamera }}">{{ $row->kamera }}</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div>
    </form>
    <script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>

    <script type="text/javascript">
        function changeCamera() {
            Instascan.Camera.getCameras().then(function(cameras) {
                let selected = $("select[name='kamera']").val()
                console.log(cameras)
                $("select[name='kamera']").html('<option>Pilih Camera</option>');
                if (cameras.length > 0) {
                    var selectedCam = cameras[0]
                    $.each(cameras, (i, c) => {
                        if (c.name == selected) {
                            selectedCam = c;
                            $("select[name='kamera']").append('<option value="' + c.name + '" selected>' + c
                                .name +
                                '</option>')
                        } else {
                            $("select[name='kamera']").append('<option value="' + c.name + '">' + c.name +
                                '</option>')
                        }
                    });
                } else {
                    console.error('No cameras found.')
                }
            }).catch(function(e) {
                console.error(e)
            })
        }

        $(function() {
            changeCamera()
        })
    </script>
@endsection
