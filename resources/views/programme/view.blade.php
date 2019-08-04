@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-4 font-weight-bold">{{$prog->id}} - {{$prog->prog_name}}</h2>
            <hr>
            <h5>Programme Level:</h5>
            <p>{{$prog->prog_level}}</p>

            <h5>Programme Overview:</h5>
            <p>{!! nl2br(e($prog->prog_desc)) !!}</p>

            <h5>Duration:</h5>
            <p>{{$prog->prog_duration}} years</p>

            <h5>Minimum Entry Requirements:</h5>
            <p>{!! nl2br(e($prog->prog_mer)) !!}</p>

            <hr>
            <h2 class="text-center font-weight-bold">Programme Outline</h2>
            <h5>Programme Main Courses:</h5>
            <ol>
                @foreach ($prog->programmeCourses as $progCourse)
                @if ($progCourse->is_elective === 0)
                <li>{{$progCourse->courses->course_name}}</li>
                @endif
                @endforeach
            </ol>

            <h5>Programme Elective Courses:</h5>
            <ol>
                @foreach ($prog->programmeCourses as $progCourse)
                @if ($progCourse->is_elective === 1)
                <li>{{$progCourse->courses->course_name}}</li>
                @endif
                @endforeach
            </ol>

            <hr>
            <h5>Campuses Offered:</h5>
            <ol>
                @foreach ($prog->campusProgrammes as $campProg)
                <li>{{$campProg->campuses->campus_name}}</li>
                @endforeach
            </ol>

            <h5>Professional Certification:</h5>
            <ol>
                @foreach ($prog->programmeCertificates as $cert)
                <li>{{$cert->certificates->cert_name}} - {{$cert->certificates->cert_desc}}</li>
                @endforeach
            </ol>
            <div class="row">
                <div class="col-md-12 my-2">
                    <a class="btn btn-outline-primary btn-block" href="/programme" role="button">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="js/sorttable.js"></script>
@endsection