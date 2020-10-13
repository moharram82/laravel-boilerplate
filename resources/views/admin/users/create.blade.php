@extends('layouts.admin')

@section('title', 'New User')

@section('content')

    <h1><i class="fas fa-users mr-3"></i>New User</h1>

    <hr class="mb-5">

    @include ('partials.errors.list')

    {{ Form::open(['route' => 'admin.users.store']) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', ['class' => 'form-control']) }}
    </div>

    <div class='form-group mt-4 mb-4'>

        <h5>Assign Roles</h5>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, null, ['id'=> 'role-' . $role->id]) }}
            {{ Form::label('role-' . $role->id, ucfirst($role->name)) }}<br>
        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', ['class' => 'form-control']) }}

    </div>

    <div class="form-group">
        {{ Form::label('password_confirmation', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}

    </div>

    {{ Form::submit('Save User', ['class' => 'btn btn-primary btn-block btn-lg mt-5']) }}

    {{ Form::close() }}

@endsection
