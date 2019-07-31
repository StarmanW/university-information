@extends('layouts.app')

@section('content')
<div class="container">
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

    <div class="row">
        <div class="col-md-6">
            <h1 class="text-center">Course List for {{$prog_id}}</h1>
            @if (count($progCourses) !== 0)
            <form method="POST" action="/programme/{{$prog_id}}/remove_prog_courses">
                @foreach ($progCourses as $course)
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="prog_courses[]" value="{{$course->id}}" >
                        {{$course->id}} {{$course->course_name}}
                    </label>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 my-3">
                        <button type="submit" class="btn btn-outline-success btn-block">Remove Courses from
                            Programme</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
        <div class="col-md-6">
            <h1 class="text-center">FOCS Course List</h1>
            @if (count($facultyCourses) !== 0)
            <form method="POST" action="/programme/{{$prog_id}}/add_prog_courses">
                @foreach ($facultyCourses as $course)
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="faculty_courses[]" value="{{$course->id}}">
                        {{$course->id}} {{$course->course_name}}
                    </label>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 my-3">
                        <button type="submit" class="btn btn-outline-success btn-block">Add Courses to
                            Programme</button>
                    </div>
                </div>
            </form>
            @endif
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