@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-responsive sortable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Certificate Name</th>
                        <th>Certificate Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $cert)
                    <tr>
                        <td>{{$cert->id}}</td>
                        <td>{{$cert->cert_name}}</td>
                        <td>{{$cert->cert_desc}}</td>
                        <td>
                            <a type="button" href="/certificates/{{$cert->id}}/edit" name="edit_view_btn"
                                id="edit_view_btn" class="btn btn-primary btn-md btn-block">Edit/View</a>
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