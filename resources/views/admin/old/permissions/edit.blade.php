@extends('layouts.admin')

@section('title', 'Edit Permission - Admin Panel')

@section('content')

    @include ('partials.errors.list')

    <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
    <br>
    {{ Form::model($permission, array('route' => array('admin.permissions.update', $permission->id), 'method' => 'PUT')) }}

    <div class="form-group">
        {{ Form::label('name', 'Permission Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>
    <br>
    {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

@endsection
