@extends('layouts.admin')

@section('title', 'Roles')

@section('content')

    <h1 class="float-left"><i class="fas fa-theater-masks mr-3"></i>Roles</h1>

    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary float-right">New Role</a>

    <div class="clearfix"></div>

    <hr class="mb-5">

    <table class="table data-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Permissions</th>
            <th>Operation</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($roles as $role)
            <tr>

                <td>{{ $role->name }}</td>

                <td>{{  $role->permissions()->pluck('name')->implode(', ') }}</td>
                <td>
                    <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-secondary pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.roles.destroy', $role->id], 'class' => 'd-inline' ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
