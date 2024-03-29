@extends('layouts.facultyAdmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('addStatus') === true)
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>New faculty staff has been successfully added!</strong>
            </div>
            @elseif (session('addStatus') === false)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>There is an issue occurred on our site while adding new faculty staff.</strong>
            </div>
            @endif

            <div class="card">
                <div class="card-header">Register New Staff for {{auth()->user()->facultyAdmins->faculty_id}}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('facultyAdminRegister') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email"
                                   class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required autocomplete="new-password">
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
                                          autocomplete="specialization">{{ old('specialization') }}</textarea>

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
                                          autocomplete="interest">{{ old('interest') }}</textarea>

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
                                    <option value="Lecturer" @if(old('position')==='Lecturer'
                                            ){{ 'selected="selected"' }}@endif>Lecturer</option>
                                    <option value="Tutor" @if(old('position')==='Tutor'
                                            ){{ 'selected="selected"' }}@endif>Tutor</option>
                                    <option value="Dean" @if(old('position')==='Dean'
                                            ){{ 'selected="selected"' }}@endif>Dean</option>
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
                                    {{ __('Register') }}
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