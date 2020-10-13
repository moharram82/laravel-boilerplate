@extends('layouts.admin')

@section('title', 'Users - Admin Panel')

@section('content')

    <h1 class="float-left"><i class="fas fa-users fa-fw mr-3"></i>Users</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">Add User</a>

    <div class="clearfix"></div>

    <hr class="mb-5">

    <table class="table data-table">

        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date/Time Added</th>
                <th>User Roles</th>
                <th>Operations</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
            <tr>
                <td><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                <td>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-secondary pull-left" style="margin-right: 3px;">Edit</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['admin.users.destroy', $user->id], 'class' => 'd-inline' ]) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>

@endsection
