@extends('layouts.facultyStaff')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            @if (session('updateStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Cer has been successfully updated!</strong>
            </div>
            @elseif (session('updateStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while updating the certificate.</strong>
            </div>
            @endif

            <h1 class="text-center">Update Certificate {{$certificate->cert_name}}</h1>
            <hr>
            <form method="POST" action="/certificates/{{ $certificate->id }}/edit" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- Certificate Name --}}
                <div class="form-group">
                    <label for="cert_name">Certificate Name:</label>
                    <input type="text" value="{{ $certificate->cert_name }}" name="cert_name" id="cert_name"
                        class="form-control" placeholder="Enter certificate name">
                </div>
                @error('cert_name')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Crogramme Description --}}
                <div class="form-group">
                    <label for="cert_desc">Certificate Description:</label>
                    <textarea class="form-control" name="cert_desc" id="cert_desc" cols="5" rows="3"
                        placeholder="Enter certificate description">{{ $certificate->cert_desc }}</textarea>
                </div>
                @error('cert_desc')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme Incorporation Offered --}}
                <div class="form-check">
                    <label for="">Programmes Incorporation:</label><br />
                    @foreach ($programmes as $prog)
                    <input type="checkbox" class="form-check-input" name="prog_incor[]" id="prog_incorp_{{$prog->id}}"
                        value="{{$prog->id}}" @if (count($prog->programmeCertificates->where('cert_id', '=',
                    $certificate->id)) === 1) {{"checked"}} @endif>
                    <label class="form-check-label" for="prog_incorp_{{$prog->id}}">
                        {{$prog->prog_name}}
                    </label>
                    <br />
                    @endforeach
                </div>

                <div class="row mt-2">
                    <div class="col-md-6">
                        <a href="/certificates" type="button" class="btn btn-outline-primary btn-block">Back</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-success btn-block">Update Certificate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/certificates.js"></script>
@endsection