@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('successAddProgElectiveCourses') === true)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Courses has been successfully added to programme!</strong>
    </div>
    @elseif (session('successAddProgElectiveCourses') === false)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>There is an issue occurred on our site while adding the courses to the programme.</strong>
    </div>
    @endif

    @if (session('successRemoveProgElectiveCourses') === true)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Courses has been successfully removed from programme!</strong>
    </div>
    @elseif (session('successRemoveProgElectiveCourses') === false)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>There is an issue occurred on our site while removing the courses from the programme.</strong>
    </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <h1 class="text-center">Elective Course List for {{$prog_id}}</h1>
            @if (count($progCourses) !== 0)
            <form method="POST" action="/programme/{{$prog_id}}/remove_prog_elective_courses">
                {{ csrf_field() }}
                @foreach ($progCourses as $course)
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="prog_courses[]" value="{{$course->id}}">
                        {{$course->course_id}} {{$course->courses->course_name}}
                    </label>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 my-3">
                        <button type="submit" class="btn btn-outline-success btn-block">Remove Elective Courses from
                            Programme</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
        <div class="col-md-6">
            <h1 class="text-center">FOCS Course List</h1>
            @if (count($facultyCourses) !== 0)
            <form method="POST" action="/programme/{{$prog_id}}/add_prog_elective_courses"
                enctype="multipart/form-data">
                {{ csrf_field() }}
                @foreach ($facultyCourses as $course)
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="faculty_courses[]"
                            value="{{$course->id}}">
                        {{$course->id}} {{$course->course_name}}
                    </label>
                </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 my-3">
                        <button type="submit" class="btn btn-outline-success btn-block">Add Elective Courses to
                            Programme</button>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-2">
            <a class="btn btn-outline-primary btn-block" href="/programme/{{$prog_id}}/edit" role="button">Back</a>
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