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

                    <div class="form-group col-md-12">
                        <bks123-file-input input-name="image" 
                                           key="image"
                                           input-class="form-control"
                                           input-id="image-upload"
                                           :multiple="true"
                                           progress-bar-color="bg-success"
                                           :allowed-extensions="['jpg', 'png', 'mp4']"
                                           upload-url="/api/upload"
                                           :batch-size="10"
                                           :max-size="50*1024*1024">Upload Files</bks123-file-input>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection