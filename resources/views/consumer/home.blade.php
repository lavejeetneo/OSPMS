@extends('layouts.consumer.default')

@section('title', 'Home Page')

@section('content')

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @include('consumer.availeCylinderDataTable')

@endsection