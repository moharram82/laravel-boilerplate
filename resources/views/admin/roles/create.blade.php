@extends('layouts.admin')

@section('title', 'New Role')

@section('content')

    <h1><i class='fa fa-theater-masks mr-3'></i>New Role</h1>

    <hr class="mb-5">

    @include ('partials.errors.list')

    {{ Form::open(['route' => 'admin.roles.store']) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <h5 class="mt-4">Assign Permissions</h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id, null, ['id'=> 'permission-' . $permission->id]) }}
            {{ Form::label('permission-' . $permission->id, ucfirst($permission->name)) }}<br>
        @endforeach
    </div>

    {{ Form::submit('Save Role', ['class' => 'btn btn-primary btn-block btn-lg mt-5']) }}

    {{ Form::close() }}

@endsection
