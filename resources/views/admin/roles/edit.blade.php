@extends('layouts.admin')

@section('title', 'Edit Role: ' . $role->name)

@section('content')

    <h1><i class='fa fa-theater-masks mr-3'></i>Edit Role: {{$role->name}}</h1>

    <hr class="mb-5">

    @include ('partials.errors.list')

    {{ Form::model($role, ['route' => ['admin.roles.update', $role->id], 'method' => 'PUT']) }}

    <div class="form-group">
        {{ Form::label('name', 'Role Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <h5 class="mt-4">Assign Permissions</h5>

    @foreach ($permissions as $permission)
        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions, ['id'=> 'permission-' . $permission->id]) }}
        {{Form::label('permission-' . $permission->id, ucfirst($permission->name)) }}<br>
    @endforeach

    {{ Form::submit('Update Role', ['class' => 'btn btn-primary btn-block btn-lg mt-5']) }}

    {{ Form::close() }}

@endsection
