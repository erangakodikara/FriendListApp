{{-- <!DOCTYPE html>
<html>
<head>
    <title>Invite Friend</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body> --}}
    @extends('layouts.app')
    @section('content')
<div class="container">

<nav class="navbar navbar-inverse">

    <ul class="nav navbar-nav">
        <li><a href="{{ URL::to('friends') }}">View All friends</a></li>
    </ul>
</nav>

<h1>Invite Friend</h1>

@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
@if (Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header"></div>

            <div class="card-body">
                <form method="POST" action="/friends">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('friends') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
{{-- </body>
</html> --}}