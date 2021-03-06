@extends('layouts.admin')

@section('title', 'Permissions')

@section('content')

    <h1 class="float-left"><i class="fas fa-key mr-3"></i>Permissions</h1>

    <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary float-right">New Permission</a>

    <div class="clearfix"></div>

    <hr class="mb-5">

    <table class="table data-table">

        <thead>
        <tr>
            <th>Name</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-secondary pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.permissions.destroy', $permission->id], 'class' => 'd-inline' ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
