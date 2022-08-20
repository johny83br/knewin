@extends('layouts.dashboard')

@section('content')

<div class="col-12">
    <h1 class="display-3">News</h1>
    <p>Write below syntaxes of the query string of the Elasticsearch to search for news:</p>
    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
    @endif
    <form action="{{ route('post-news') }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" class="form-control" placeholder="" name="query">
            <button type="submit" class="btn btn-outline-secondary" type="button">Search</button>
        </div>
    </form>
</div>

@endsection
