@extends('layouts.master')
@section('title', 'Categories')
@section('content')

<h1>Add New Categories</h1>

<a href="{{ routeAdmin('categories/create') }}" class="btn btn-info">Create</a>

@endsection