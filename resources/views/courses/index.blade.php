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
                <strong>Course has been successfully deleted!</strong>
            </div>
            @elseif (session('deleteStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while deleting the course.</strong>
            </div>
            @endif

            <table class="table table-responsive sortable">
                <thead class="thead-dark">
                    <tr>
                        <th>Course ID</th>
                        <th>Course Name</th>
                        <th>Credit Hour</th>
                        <th>Course Fee (RM)</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    {!!$courses!!}

                    <form method="post" class="del_form" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="js/sorttable.js"></script>
<script src="js/delete_utils.js"></script>
@endsection