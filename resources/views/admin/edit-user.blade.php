<!--
Author: Chong Jia Herng
--->

@extends('layouts.admin')
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

            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form name="edit-user" method="POST">
                        @csrf

                        <div class="form-group row">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('ID') }}</label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control @error('id') is-invalid @enderror" name="id" value="{{ $user->id }}" required autocomplete="name" autofocus>

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
                                @if ($user->role === 'Admin')
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{!! \App\Model\Admin::find($user->id)->name !!}" required autocomplete="name" autofocus>
                                @elseif ($user->role === 'Staff')
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{!! \App\Model\FacultyStaff::find($user->id)->name !!}" required autocomplete="name" autofocus>
                                @else
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{!! \App\Model\FacultyAdmin::find($user->id)->name !!}" required autocomplete="name" autofocus>
                                @endif

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
                                <select onchange="showDiv(this)" name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="Admin" @if($user->role === 'Admin'){{ 'selected="selected"' }}@endif>Admin</option>
                                    <option value="Faculty Admin" @if($user->role === 'Faculty Admin'){{ 'selected="selected"' }}@endif>Faculty Admin</option>
                                    <option value="Staff" @if($user->role === 'Staff'){{ 'selected="selected"' }}@endif>Staff</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @php( $faculties = \App\Model\Faculty::all() )
                        <div class="form-group row faculty-admin-and-staff" style="display: none">
                            <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>

                            <div class="col-md-6">
                                <select name="faculty" class="form-control @error('faculty') is-invalid @enderror">
                                    @foreach ($faculties as $faculty)
                                    <option  value="{{ $faculty->id }}" @if(old('faculty') === '{{ $faculty->id }}'){{ 'selected="selected"' }}@endif>{{ $faculty->id }}{{ " - " }}{{ $faculty->faculty_name }}</option>
                                    @endforeach
                                </select>

                                @error('faculty')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row staff" style="display: none">
                            <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }} required</label>

                            <div class="col-md-6">
                                <textarea id="specialization" rows="4" cols="20" class="form-control @error('specialization') is-invalid @enderror" name="specialization" autocomplete="specialization">{{ old('specialization') }}</textarea>

                                @error('specialization')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row staff" style="display: none">
                            <label for="interest" class="col-md-4 col-form-label text-md-right">{{ __('Area(s) of Interest') }} required</label>

                            <div class="col-md-6">
                                <textarea id="interest" rows="4" cols="20" class="form-control @error('interest') is-invalid @enderror" name="interest" autocomplete="interest">{{ old('interest') }}</textarea>

                                @error('interest')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row staff" style="display: none">
                            <label for="position" class=" col-md-4 col-form-label text-md-right">{{ __('Position') }}</label>

                            <div class="col-md-6">
                                <select name="position" class="form-control @error('position') is-invalid @enderror">
                                    <option value="Lecturer" @if(old('position') === 'Lecturer'){{ 'selected="selected"' }}@endif>Lecturer</option>
                                    <option value="Tutor" @if(old('position') === 'Tutor'){{ 'selected="selected"' }}@endif>Tutor</option>
                                    <option value="Dean" @if(old('position') === 'Dean'){{ 'selected="selected"' }}@endif>Dean</option>
                                </select>

                                @error('position')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

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

<script>
    function showDiv(element)
    {
        Array.from(document.querySelectorAll('.staff')).forEach((item) => {
          item.style.display = element.value == 'Staff' ? '' : 'none'; 
        })
        
        Array.from(document.querySelectorAll('.faculty-admin')).forEach((item) => {
          item.style.display = element.value == 'Faculty Admin' ? '' : 'none'; 
        })
        
        Array.from(document.querySelectorAll('.faculty-admin-and-staff')).forEach((item) => {
            if (element.value == 'Faculty Admin' || element.value == 'Staff') {
                item.style.display = '';
            } else {
                item.style.display = 'none';
            }
        })
    }
</script>
@endsection