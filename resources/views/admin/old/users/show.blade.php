@extends('layouts.admin')

@section('title', $user->name . ' - Admin Panel')

@section('content')

    <h1>{{ $user->name }}</h1>

@endsection
