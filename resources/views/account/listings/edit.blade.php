@extends('account.dashboard.layouts.default')

@section('dashboard.content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-content-center">
                <div>Edit Listing</div>
                <aside>
                    @if($listing->live())
                        <a href="{{ route('area.listings.show', [$area, $listing]) }}">Go to listing</a>
                    @endif
                </aside>
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('account.listings.update', $listing) }}">
                @csrf

                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>

                    <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           name="title" value="{{ old('title', $listing->title) }}" required autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                @include('listings.partials.forms._areas', ['area_id' => $listing->area_id])

                @include('listings.partials.forms._categories', [
                    'category_id' => $listing->category_id,
                    'listing' => $listing,
                ])

                @if($listing->published())
                    <input type="hidden" name="category_id" value="{{ $listing->category_id }}">
                @endif

                <div class="form-group">
                    <label for="body">Description</label>
                    <textarea name="body" id="body"
                              cols="30" rows="6"
                              class="form-control{{ $errors->has('body') ? ' is-invalid' : '' }}">{{ old('body', $listing->body) }}</textarea>

                    @if($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>

                @if($listing->published())
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"
                                   name="live"
                                   class="custom-control-input"
                                   id="live"
                                   value="1"
                                    {{ old('live', $listing->live) == 1 ? ' checked' : '' }}>
                            <label class="custom-control-label" for="live">Live</label>
                        </div>

                        @if ($errors->has('live'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('live') }}</strong>
                            </span>
                        @endif
                    </div>
                @endif

                <div class="form-group clearfix">
                    <button type="submit" class="btn btn-success">Save</button>

                    @if(!$listing->published())
                        <button type="submit" name="checkout" class="btn btn-primary float-right" value="1">
                            Continue to payment
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection