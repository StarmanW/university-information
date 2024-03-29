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
                <strong>New programme has been successfully added!</strong>
            </div>
            @elseif (session('addStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while adding new programme.</strong>
            </div>
            @endif

            <h1 class="text-center">Add New Programme</h1>
            <hr>
            <form method="POST" action="/faculty_staff/programme/add" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- Programme ID --}}
                <div class="form-group">
                    <label for="prog_id">Programme ID:</label>
                    <input type="text" value="{{ old('prog_id') }}" name="prog_id" id="prog_id" maxlength="3"
                        class="form-control" placeholder="Enter programme ID">
                </div>
                @error('prog_id')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme Name --}}
                <div class="form-group">
                    <label for="prog_name">Programme Name:</label>
                    <input type="text" value="{{ old('prog_name') }}" name="prog_name" id="prog_name"
                        class="form-control" placeholder="Enter programme name">
                </div>
                @error('prog_name')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme Description --}}
                <div class="form-group">
                    <label for="prog_desc">Programme Description:</label>
                    <textarea class="form-control" name="prog_desc" id="prog_desc" cols="5" rows="3"
                        placeholder="Enter programme description">{{ old('prog_desc') }}</textarea>
                </div>
                @error('prog_desc')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme MER --}}
                <div class="form-group">
                    <label for="prog_mer">Minimum Entry Requirements:</label>
                    <textarea class="form-control" name="prog_mer" id="prog_mer" cols="5" rows="3"
                        placeholder="Enter programme minimum entry requirements">{{ old('prog_mer') }}</textarea>
                </div>
                @error('prog_mer')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme Duration --}}
                <div class="form-group">
                    <label for="prog_duration">Programme Duration:</label>
                    <input type="number" name="prog_duration" value="{{ old('prog_duration') }}" id="prog_duration"
                        class="form-control" min="1" max="4" placeholder="Enter programme study duration (years)">
                </div>
                @error('prog_duration')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Programme Study Level --}}
                <div class="form-group">
                    <label for="prog_level">Programme Level:</label>
                    <select class="form-control" name="prog_level" id="prog_level">
                        <option value="Diploma" @if(old('prog_level')==="Diploma" ) {{'selected="selected"'}}@endif>
                            Diploma</option>
                        <option value="Bachelor Degree" @if(old('prog_level')==="Bachelor Degree" )
                            {{'selected="selected"'}}@endif>Bachelor Degree</option>
                        <option value="Master" @if(old('prog_level')==="Master" ) {{'selected="selected"'}}@endif>Master
                        </option>
                        <option value="Doctorate (PhD)" @if(old('prog_level')==="Doctorate (PhD)" )
                            {{'selected="selected"'}}@endif>Doctorate (PhD)</option>
                    </select>
                </div>
                @error('prog_level')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Campuses Programme Offered --}}
                <div class="form-check">
                    <label for="">Campuses Offered:</label><br/>
                    @foreach ($campuses as $campus)
                    <input type="checkbox" class="form-check-input" name="branch_offered[]"
                        id="branch_{{$campus->id}}" value="{{$campus->id}}">
                    <label class="form-check-label" for="branch_{{$campus->id}}">
                        {{$campus->campus_name}}
                    </label>
                    @error('branch_offered[]')
                    <p class="text-danger font-weight-bold">{{ $message }}</p>
                    @enderror
                    <br />
                    @endforeach
                </div>

                <div class="row my-2">
                    <div class="col-md-6">
                        <button type="reset" class="btn btn-outline-primary btn-block">Reset</button>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-outline-success btn-block">Add New Programme</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        setTimeout(() => {
            document.querySelector('.alert').remove();
        }, 5000);
    })();
</script>
@endsection