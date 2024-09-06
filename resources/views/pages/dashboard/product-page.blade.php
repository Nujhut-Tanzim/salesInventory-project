@extends('layout.sidenav-layout')
@section('title')
        @include('components.dashboard.profile-userName')
@endsection
@section('content')
    @include('components.product.product_list')
    @include('components.product.product_delete')
    @include('components.product.product_create')
    @include('components.product.product_update')

@endsection

