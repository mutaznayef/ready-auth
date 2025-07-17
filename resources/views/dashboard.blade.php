@extends('layout.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <h1>Welcome, {{ auth()->user()->name }}!</h1>
        <p>You are now logged in.</p>
    </div>
</div>
@endsection