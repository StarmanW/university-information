@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            @if (session('addStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>New course has been successfully added!</strong>
            </div>
            @elseif (session('addStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while adding new course.</strong>
            </div>
            @endif

            <h1 class="text-center">Add New Course</h1>
            <hr>
            <form method="POST" action="/courses/add" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{-- Course ID --}}
                <div class="form-group">
                    <label for="course_id">Course ID:</label>
                    <input type="text" value="{{ old('course_id') }}" name="course_id" id="course_id" maxlength="8"
                        class="form-control" placeholder="Enter course ID">
                </div>
                @error('course_id')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Course Name --}}
                <div class="form-group">
                    <label for="course_name">Course Name:</label>
                    <input type="text" value="{{ old('course_name') }}" name="course_name" id="course_name"
                        class="form-control" placeholder="Enter course name">
                </div>
                @error('course_name')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Course Description --}}
                <div class="form-group">
                    <label for="course_desc">Course Description:</label>
                    <textarea class="form-control" name="course_desc" id="course_desc" cols="5" rows="3"
                        placeholder="Enter course description">{{ old('course_desc') }}</textarea>
                </div>
                @error('course_desc')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Course credit hour --}}
                <div class="form-group">
                    <label for="course_cred_hour">Course Credit Hour:</label>
                    <input type="number" name="course_cred_hour" value="{{ old('course_cred_hour') }}" id="course_cred_hour"
                        class="form-control" min="1" max="4" placeholder="Enter course credit hour">
                </div>
                @error('course_cred_hour')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                {{-- Course fee --}}
                <div class="form-group">
                    <label for="course_fee">Course Fee:</label>
                    <input type="number" step=".01" name="course_fee" value="{{ old('course_fee') }}" id="course_fee"
                        class="form-control" min="1" placeholder="Enter course fee">
                </div>
                @error('course_fee')
                <p class="text-danger font-weight-bold">{{ $message }}</p>
                @enderror

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-outline-success btn-block">Add New Course</button>
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