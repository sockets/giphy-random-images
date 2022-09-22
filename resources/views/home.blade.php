@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Giphy Image Search') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('giphy') }}" method="POST">
                        {!! csrf_field() !!} 
		                <div class="mb-3 {{ $errors->has('search') ? 'has-error' : '' }}">
                            <label class="form-label" for="search_query">Search Query</label>
                            <input value="" class="form-control" type="text" name="search_query" placeholder="Enter search query" required="required" id="search_query">
                            <small id="giphyAttribution" class="form-text text-muted">Powered By GIPHY</small>
                        </div>
                        <button class="btn btn-success">Search</button>
                    </form>
                </div>
            </div>
            
            @if (session('result'))
                <div class="card mt-4">
                    <div class="card-header">{{ __('Giphy Image') }}</div>

                    <div class="card-body">
                        <img class="card-img-top" src="{{ session('result') }}" alt="Giphy Image">
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
