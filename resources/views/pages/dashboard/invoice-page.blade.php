@extends('layout.sidenav-layout')
@section('title')
        @include('components.dashboard.profile-userName')
@endsection
@section('content')
    @include('components.invoice.invoice-details')
    @include('components.invoice.invoice-list')
    @include('components.invoice.invoice-delete')

@endsection

