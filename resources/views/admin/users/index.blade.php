@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    <h1 class="float-left"><i class="fas fa-users mr-3"></i>Users</h1>

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary float-right">New User</a>

    <div class="clearfix"></div>

    <hr class="mb-5">

    <table class="table data-table">

        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Email</th>
                <th>Created On</th>
                <th>Roles</th>
                <th>Operations</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($users as $user)
            <tr>
                <td style="width: 45px;">
                    @if($user->profile_picture && Storage::exists('public/profiles/' . $user->profile_picture))
                    <img class="rounded-circle" src="{{ asset('storage/profiles/' . $user->profile_picture) }}" alt="Profile Picture" style="width: 40px;">
                    @else
                    <img class="rounded-circle" src="{{ asset('storage/profiles/default.jpg') }}" alt="Profile Picture" style="width: 40px;">
                    @endif
                </td>
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
