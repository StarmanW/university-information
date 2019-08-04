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
                            <th>Name</th>
                            <th>Position</th>
                            <th>Faculty</th>
                            <th>Specialization</th>
                            <th>Area of Interest</th>
                        </thead>
                        <tbody>
                            {!!$staffList!!}
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection