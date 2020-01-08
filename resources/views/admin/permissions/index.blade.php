@extends('layouts.admin')

@section('title', 'Permissions - Admin Panel')

@section('content')

    <h1 class="float-left"><i class="fas fa-key fa-fw mr-3"></i>Permissions</h1>

    <a href="{{ URL::to('admin/permissions/create') }}" class="btn btn-primary float-right">Add Permission</a>

    <div class="clearfix"></div>

    <hr class="mb-5">

    <table class="table data-table">

        <thead>
        <tr>
            <th>Permissions</th>
            <th>Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <td>{{ $permission->name }}</td>
                <td>
                    <a href="{{ URL::to('admin/permissions/'.$permission->id.'/edit') }}" class="btn btn-secondary pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.permissions.destroy', $permission->id], 'class' => 'd-inline' ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
