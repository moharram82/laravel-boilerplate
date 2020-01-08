@extends('layouts.admin')

@section('title', 'Edit Role - Admin Panel')

@section('content')

    <h1><i class='fa fa-key'></i> Edit Role: {{$role->name}}</h1>
    <hr>

    @include ('partials.errors.list')

    {{ Form::model($role, array('route' => array('admin.roles.update', $role->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Role Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign Permissions</b></h5>
    @foreach ($permissions as $permission)

        {{Form::checkbox('permissions[]',  $permission->id, $role->permissions ) }}
        {{Form::label($permission->name, ucfirst($permission->name)) }}<br>

    @endforeach
    <br>
    {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection
