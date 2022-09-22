@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Image History') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <table class="table table-bordered mb-5">
                        <thead>
                            <tr class="table-primary">
                                <th scope="col">#</th>
                                <th scope="col">Search</th>
                                <th scope="col">Result</th>
                                <th scope="col">Time</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userHistory as $data)
                            <tr>
                                <th scope="row">{{ $data->id }}</th>
                                <th scope="row">{{ $data->search }}</th>
                                <th scope="row"><a href="{{ $data->return }}">{{ $data->return }}</a></th>
                                <th scope="row">{{date_format(date_create($data->created_at), 'm/d/Y H:i:s')}}</th>
                                <th scope="row"><a href="{{ route('deleteHistory', ['id'=>$data->id]) }}" class="text-danger">Delete</a></th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $userHistory->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
