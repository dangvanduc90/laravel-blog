@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ action('PostController@store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('title') }}</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}">

                                @if ($errors->has('title'))
                                    @foreach ($errors->get('title') as $message)
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('body') }}</label>
                            <div class="col-md-6">
                                <input id="body" type="text" class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}" name="body" value="{{ old('body') }}">

                                @if ($errors->has('body'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author[name]" class="col-md-4 col-form-label text-md-right">{{ __('author[name]') }}</label>
                            <div class="col-md-6">
                                <input id="author[name]" type="text" class="form-control{{ $errors->has('author.name') ? ' is-invalid' : '' }}" name="author[name]" value="{{ old('author.name') }}">

                                @if ($errors->has('author.name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author.name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author.description" class="col-md-4 col-form-label text-md-right">{{ __('author[description]') }}</label>
                            <div class="col-md-6">
                                <input id="author.description" type="text" class="form-control{{ $errors->has('author.description') ? ' is-invalid' : '' }}" name="author[description]" value="{{ old('author.description') }}">

                                @if ($errors->has('author.description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('author.description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
