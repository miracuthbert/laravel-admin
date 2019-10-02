@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Recently Viewed Listings</h4>
                <p>Showing your last {{ config('classifieds.listings.viewed.limit') }} viewed listings.</p>
                <hr>

                @forelse($listings as $listing)
                    @include('listings.partials._listing_viewed', compact('listing'))
                @empty
                    <p>You have no viewed listings.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
