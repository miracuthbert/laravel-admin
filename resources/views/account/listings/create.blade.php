@extends('account.dashboard.layouts.default')

@section('dashboard.content')
    <div class="card">
        <div class="card-header">Create Listing</div>
        <div class="card-body">
            <form method="POST" action="{{ route('account.listings.store') }}">
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>

                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title" value="{{ old('title') }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                @include('listings.partials.forms._areas')

                @include('listings.partials.forms._categories')

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea name="body" id="body"
                              cols="30" rows="6"
                              class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}">{{ old('body') }}</textarea>

                    @if($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection