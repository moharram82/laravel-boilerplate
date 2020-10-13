@extends('layouts.admin')

@section('title', 'Edit User: ' . $user->name)

@section('content')

    <h1><i class="fas fa-users mr-3"></i>Edit User: {{$user->name}}</h1>

    <hr class="mb-5">

    @include ('partials.errors.list')

    {{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT', 'files' => true]) }} {{-- Form model binding to automatically populate our fields with user data --}}

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

    <div class="form-group">
    @if($user->profile_picture && Storage::exists('public/profiles/' . $user->profile_picture))
        <img class="mb-3" src="{{ asset('storage/profiles/' . $user->profile_picture) }}" alt="Profile Picture" style="width: 128px;">
        <br>
        {{ Form::checkbox('delete_picture', 1, null, ['id' => 'delete_picture']) }}
        {{ Form::label('delete_picture', 'Delete Picture') }}
    @else
        {{ Form::label('profile_picture', 'Profile Picture') }}
        {{ Form::file('profile_picture', ['class' => 'form-control']) }}
    @endif
    </div>

    {{ Form::submit('Update User', ['class' => 'btn btn-primary btn-block btn-lg mt-5']) }}

    {{ Form::close() }}

@endsection
