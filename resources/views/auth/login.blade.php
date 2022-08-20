@extends('layouts.login')

@section('content')
<div class="card-body">
    @error('email')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror

    @error('password')
    <div class="alert alert-danger" role="alert">
        {{ $message }}
    </div>
    @enderror

    <login-component></login-component>
</div>
@endsection
