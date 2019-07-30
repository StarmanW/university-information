@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>

                <div class="card-body">
                    <form name="edit-user" method="POST">
                        <div>
                            <label>ID</label>
                            <input type="text" name="" value="{{ $user->id }}" readonly="readonly" />
                        </div>
                        <div>
                            <label>Email</label>
                            <input type="text" name="" value="{{ $user->email }}" readonly="readonly" />
                        </div>
                        <div>
                            <label>Role</label>
                            <select name="role">
                                <option value="Admin">Admin</option>
                                <option value="Staff">Staff</option>
                            </select>
                        </div>
                        <input type="submit" value="Save" name="save" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection