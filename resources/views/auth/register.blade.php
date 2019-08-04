@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                            <div class="col-md-6">
                                <select onchange="showDiv(this)" name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="Admin" selected="selected"@if(old('role') === 'Admin'){{ 'selected="selected"' }}@endif>Admin</option>
                                    <option value="Staff" @if(old('role') === 'Staff'){{ 'selected="selected"' }}@endif>Staff</option>
                                </select>

                                @error('role')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        @php( $faculties = \App\Model\Faculty::all() )
                        <div class="form-group row staff" style="display: none">
                            <label for="faculty" class="col-md-4 col-form-label text-md-right">{{ __('Faculty') }}</label>

                            <div class="col-md-6">
                                <select name="faculty" class="form-control @error('faculty') is-invalid @enderror">
                                    @foreach ($faculties as $faculty)
                                    <option  value="{{ $faculty->id }}" @if(old('faculty') === '{{ $faculty->faculty_name }}'){{ 'selected="selected"' }}@endif>{{ $faculty->faculty_name }}</option>
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

<script>
    function showDiv(element)
    {
        Array.from(document.querySelectorAll('.staff')).forEach((item) => {
          item.style.display = element.value == 'Staff' ? '' : 'none'; 
        })
    }
</script>

@endsection
