@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            @if (session('deleteStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Certificate has been successfully deleted!</strong>
            </div>
            @elseif (session('deleteStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while deleting the certificate.</strong>
            </div>
            @endif

            <table class="table table-responsive sortable">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Certificate Name</th>
                        <th>Certificate Description</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($certificates as $cert)
                    <tr>
                        <td>{{$cert->id}}</td>
                        <td>{{$cert->cert_name}}</td>
                        <td>{{str_limit($cert->cert_desc, $limit = 50, $end = '...')}}</td>
                        <td>
                            <a type="button" href="/certificates/{{$cert->id}}/edit" name="edit_btn" id="edit_btn"
                                class="btn btn-outline-primary btn-md btn-block">Edit</a>
                        </td>
                        <td>
                            <a href="#" class="btn btn-outline-danger btn-block"
                                onclick="deleteCertificate('{{$cert->id}}', '{{$cert->cert_name}}')">Delete</a>
                            <form method="post" action="/certificates/{{$cert->id}}/delete" id="delete{{$cert->id}}"
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

<script src="js/sorttable.js"></script>
<script src="js/delete_utils.js"></script>
@endsection