@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <table class="table table-responsive">
                <thead class="thead-dark">
                    <tr>
                        <th>Programme</th>
                        <th>Programme Name</th>
                        <th>Programme Level</th>
                        <th>Min. Entry Req (MER)</th>
                        <th>Duration of Study</th>
                        <th>No. of Subjects</th>
                        <th>No. of Elective Subjects</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($programmes as $prog)
                    <tr>
                        <td scope="row"></td>
                        <td>{{$prog->id}}</td>
                        <td>{{$prog->prog_name}}</td>
                        <td>{{$prog->level}}</td>
                        <td>{{$prog->prog_mer}}</td>
                        <td>{{$prog->prog_duration}}</td>
                        <td>{{$prog->id}}</td>
                        <td>{{$prog->id}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection