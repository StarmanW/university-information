@extends('layouts.facultyAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('roleError') !== null)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{ session('roleError') }}</strong>
            </div>
            @endif

            @if (session('updateStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>Faculty staff has been successfully updated!</strong>
            </div>
            @elseif (session('updateStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while updating the faculty staff.</strong>
            </div>
            @endif

            <div class="card">
                <div class="card-header">Edit Staff Details</div>

                <div class="card-body">
                    <form method="POST" action="/faculty_admin/{{$staff->id}}/edit">
                        @csrf

                        @if ($staff->role === 'Faculty Admin')
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $staff->id }}" required autocomplete="name" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $staff->facultyAdmins->name }}" readonly="readonly"
                                    autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role" id='role' class="form-control @error('role') is-invalid @enderror">
                                    <option value='Staff'>Staff</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row staff">
                            <label for="specialization"
                                class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}
                                </label>

                            <div class="col-md-6">
                                <textarea id="specialization" rows="4" cols="20"
                                    class="form-control @error('specialization') is-invalid @enderror"
                                    name="specialization"
                                    autocomplete="specialization"></textarea>

                                @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row staff">
                            <label for="interest"
                                class="col-md-4 col-form-label text-md-right">{{ __('Area(s) of Interest') }}
                                </label>

                            <div class="col-md-6">
                                <textarea id="interest" rows="4" cols="20"
                                    class="form-control @error('interest') is-invalid @enderror" name="interest"
                                    autocomplete="interest"></textarea>

                                @error('interest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row staff">
                            <label for="position"
                                class=" col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                            <div class="col-md-6">
                                <select name="position" class="form-control @error('position') is-invalid @enderror">
                                    <option value="Lecturer" >Lecturer</option>
                                    <option value="Tutor" >Tutor</option>
                                    <option value="Dean" >Dean</option>
                                </select>

                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $staff->id }}" required autocomplete="name" autofocus>

                                @error('id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $staff->facultyStaffs->name }}" readonly="readonly"
                                    autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select name="role" id='role' class="form-control @error('role') is-invalid @enderror">
                                    <option value='Faculty Admin'>Faculty Admin</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        @endif

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection