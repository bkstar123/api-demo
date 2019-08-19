@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="video">Upload Images</label>
                        <input type="file" class="form-control" name="image" id="image-upload" multiple>
                        <div class="gallery" id="gallery"></div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="/js/uploader.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#image-upload').bkstar123_ajaxuploader({
        allowedExtensions: ['png','jpg','jpeg', 'mp4' , 'pages'],
        batchSize: 5,
        size: 50*1024*1024,
        //progressBarColor: 'bg-success',
        outerClass: 'col-md-12',
        uploadUrl: '/api/upload',
        beforeSend: (xhr) => {
            xhr.setRequestHeader('X-AUTHOR', 'TUANHA');
        },
        onResponse: (response) => {
            let res = JSON.parse(response)
            if (res.data) {
                $('#gallery').append(`<img id="${res.data.filename}" src="${res.data.url}" width="50px">`);
            }
        }
    });
});
</script>
@endpush