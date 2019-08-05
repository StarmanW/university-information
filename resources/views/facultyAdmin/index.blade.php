@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body mx-auto">
                    <table border="0" class="table table-responsive table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facultyStaffs as $staff)
                            <tr>
                                <td>{{ $staff->id }}</td>
                                @if ($staff->role === 'FacultyAdmin')
                                    <td>{{$staff->facultyAdmins->name}}</td>
                                @elseif ($staff->role === 'Staff')
                                    <td>{{$staff->facultyStaffs->name}}</td>
                                @endif
                                <td>{{ $staff->email }}</td>
                                <td>{{ $staff->role }}</td>
                                <td><a href="/faculty_admin/{{ $staff->id }}/edit">Edit</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection