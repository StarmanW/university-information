@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <table class="table table-responsive sortable">
                <thead class="thead-dark">
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Faculty</th>
                        <th>Specialization</th>
                        <th>Area of Interest</th>
                    </tr>
                </thead>
                <tbody>
                    {!!$staffList!!}
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection