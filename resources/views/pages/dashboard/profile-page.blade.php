@extends('layout.sidenav-layout')
@section('title')
        @include('components.dashboard.profile-userName')
@endsection
    
@section('content')
    @include('components.dashboard.profile-form')
@endsection

