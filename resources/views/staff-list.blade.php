@extends(((Auth::user()->role === 'Admin') ? 'layouts.admin' : 'layouts.facultyStaff'))

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($XMLStatus === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ 'XML file is validated and saved.' }}</strong>
            </div>
            @elseif ($XMLStatus === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ 'XML file is not valid. Please check XML file generated for more details.' }}</strong>
            </div>
            @endif
            
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
                            {!! $staffList !!}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection