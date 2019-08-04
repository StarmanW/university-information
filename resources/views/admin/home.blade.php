@extends('layouts.app')
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
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                @if ($user->role === 'Admin')
                                    <td>{!! \App\Model\Admin::find($user->id)->name !!}</td>
                                @else
                                    <td>{!! \App\Model\FacultyStaff::find($user->id)->name !!}</td>
                                @endif
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>
                                <td><a href="/admin/user/{{ $user->id }}/edit">Edit</a></td>
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