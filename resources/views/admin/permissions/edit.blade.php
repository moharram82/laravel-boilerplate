@extends('layouts.admin')

@section('title', 'Edit Permission: ' . $permission->name)

@section('content')

    @include ('partials.errors.list')

    <h1><i class='fa fa-key mr-3'></i>Edit Permission: {{$permission->name}}</h1>

    <hr class="mb-5">

    {{ Form::model($permission, ['route' => ['admin.permissions.update', $permission->id], 'method' => 'PUT']) }}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    @if(! $roles->isEmpty())

        <h5 class="mt-4">Assign Permission to Roles</h5>

        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id, null, ['id'=> 'role-' . $role->id]) }}
            {{ Form::label('role-' . $role->id, ucfirst($role->name)) }}<br>
        @endforeach

    @endif

    {{ Form::submit('Update Permission', ['class' => 'btn btn-primary btn-block btn-lg mt-5']) }}

    {{ Form::close() }}

@endsection
