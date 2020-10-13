@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->name)

@section('content')

    <h1><i class="fas fa-users mr-3"></i>Edit User: {{$user->name}}</h1>

    <hr class="mb-5">

    @include ('partials.errors.list')

    {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) }} {{-- Form model binding to automatically populate our fields with user data --}}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}
    </div>

    <div class='form-group mt-4 mb-4'>

        <h5>Assign Roles</h5>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]', $role->id, $user->roles, ['id'=> 'role-' . $role->id]) }}
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

    {{ Form::submit('Update User', ['class' => 'btn btn-primary btn-block btn-lg mt-5']) }}

    {{ Form::close() }}

@endsection
