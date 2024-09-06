@extends('layout.sidenav-layout')
@section('title')
        @include('components.dashboard.profile-userName')
@endsection
@section('content')
    @include('components.category.category_list')
    @include('components.category.category_delete')
    @include('components.category.category_create')
    @include('components.category.category_update')

@endsection

