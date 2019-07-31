@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <table class="table table-responsive sortable">
                <thead class="thead-dark">
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Credit Hour</th>
                        <th>Course Fee</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                    <tr>
                        <td>{{$course->id}}</td>
                        <td>{{$course->course_name}}</td>
                        <td>{{$course->course_cred_hour}}</td>
                        <td>{{$course->course_fee}}</td>
                        <td>
                        <a type="button" href="/courses/{{$course->id}}/edit" name="edit_view_btn" id="edit_view_btn" class="btn btn-primary btn-md btn-block">Edit/View</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/sorttable.js"></script>
@endsection