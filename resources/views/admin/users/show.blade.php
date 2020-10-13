@extends('layouts.admin')

@section('title', $user->name)

@section('content')

    <h1><i class="fas fa-users mr-3"></i>User Details</h1>

    <hr class="mb-5">

    <div class="float-lg-right">
        @if($user->profile_picture && Storage::exists('public/profiles/' . $user->profile_picture))
            <img class="profile-pic" src="{{ asset('storage/profiles/' . $user->profile_picture) }}" style="width: 256px;" alt="Profile Picture">
        @else
            <img class="profile-pic" src="{{ asset('storage/profiles/default.jpg') }}" style="width: 256px;" alt="Profile Picture">
        @endif
    </div>

    <div class="float-left">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }} @if($user->email_verified_at) <span class="font-weight-bold">(verified)</span> @else <a href="{{ route('verification.notice') }}">verify</a> @endif</p>
        <p><strong>Created at:</strong> {{ $user->created_at }}</p>
    </div>

    <div class="clearfix"></div>

@endsection
