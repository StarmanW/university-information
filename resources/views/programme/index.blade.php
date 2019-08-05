@extends('layouts.facultyStaff')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if (session('deleteStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Programme has been successfully deleted!</strong>
            </div>
            @elseif (session('deleteStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while deleting the programme.</strong>
            </div>
            @endif

            <table class="table table-responsive sortable">
                <thead class="thead-dark">
                    <tr>
                        <th>Programme</th>
                        <th>Programme Name</th>
                        <th>Programme Level</th>
                        <th>Duration of Study</th>
                        <th>No. of Subjects</th>
                        <th>No. of Elective Subjects</th>
                        <th>No. of Professional Certificates</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programmes as $prog)
                    <tr>
                        <td>{{$prog->id}}</td>
                        <td>{{$prog->prog_name}}</td>
                        <td>{{$prog->prog_level}}</td>
                        <td>{{$prog->prog_duration}}</td>
                        <td>{{count($prog->programmeCourses)}}</td>
                        <td>{{count($prog->programmeCourses->where('is_elective', '=', 1))}}</td>
                        <td>{{count($prog->programmeCertificates)}}</td>
                        <td>
                            <a type="button" href="/programme/{{$prog->id}}/view" name="view_btn" id="view_btn"
                                class="btn btn-outline-success btn-md btn-block">View</a>
                        </td>
                        <td>
                            <a type="button" href="/programme/{{$prog->id}}/edit" name="edit_btn" id="edit_btn"
                                class="btn btn-outline-primary btn-md btn-block">Edit</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-danger btn-block"
                                onclick="deleteProgramme('{{$prog->id}}')">Delete</a>
                            <form method="post" action="/programme/{{$prog->id}}/delete" id="delete{{$prog->id}}"
                                style="display: none;">
                                {{csrf_field()}}
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="/js/sorttable.js"></script>
<script src="/js/delete_utils.js"></script>
@endsection