@extends('layout.sidenav-layout')
@section('title')
        @include('components.dashboard.profile-userName')
@endsection
@section('content')
    @include('components.customer.customer_list')
    @include('components.customer.customer_delete')
    @include('components.customer.customer_create')
    @include('components.customer.customer_update')

@endsection

