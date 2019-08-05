@extends('layouts.facultyStaff')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            @if (session('addStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>New certificate has been successfully added!</strong>
            </div>
            @elseif (session('addStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while adding new certificate.</strong>
            </div>
            @endif

            <h1 class="text-center">Add New Certificate</h1>
            <hr>
            <form method="POST" action="/faculty_staff/certificates/add" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- Certificate Name --}}
                <div class="form-group">
                    <label for="cert_name">Certificate Name:</label>
                    <input type="text" value="{{ old('cert_name') }}" name="cert_name" id="cert_name"
                        class="form-control" placeholder="Enter certificate name">
                </div>
                @error('cert_name')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Crogramme Description --}}
                <div class="form-group">
                    <label for="cert_desc">Certificate Description:</label>
                    <textarea class="form-control" name="cert_desc" id="cert_desc" cols="5" rows="3"
                        placeholder="Enter certificate description">{{ old('cert_desc') }}</textarea>
                </div>
                @error('cert_desc')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme Incorporation Offered --}}
                <div class="form-check prog_incorp">
                    <label for="">Programmes Incorporation:</label><br />
                </div>

                <div class="row my-2">
                    <div class="col-md-6">
                        <button type="reset" class="btn btn-outline-primary btn-block">Reset</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-success btn-block">Add New Certificate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="/js/certificates.js"></script>
@endsection