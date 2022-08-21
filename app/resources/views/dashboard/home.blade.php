@extends('layouts.dashboard')

@section('content')

<div class="col-12 mb-5">
    <h1 class="display-3">News</h1>
    <p>Write below syntaxes of the query string of the Elasticsearch to search for news:</p>
    @if(Session::has('message'))
    <div class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</div>
    @endif
    <form action="{{ route('post-news') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="" name="query" value="{{ $query }}">
            <button type="submit" class="btn btn-outline-secondary" type="button">Search</button>
        </div>
    </form>

</div>

@if($news)
<div class="col-12">

    <div class="table-responsive-sm">

        <table class="table table-hover mb-0 align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th class="text-center">Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($news as $k => $n)
                <tr>
                    <td>{{ $n['_id'] }}</td>
                    <td>{{ $n['_source']['title'] }}</td>
                    <td class="text-center">
                        {{ $n['_source']['created_at'] }}
                    </td>
                    <td>
                        <div class="d-grid gap-1">
                            <button class="btn btn-sm btn-secondary" data-id="{{ $n['_id'] }}" type="button" data-bs-toggle="modal" data-bs-target="#news">View</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

<div class="col-12 mt-3 mb-5 justify-content-end">
    {{ $news->links() }}
</div>

<div class="modal fade" id="news" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endif

@endsection
