@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Your Listings</h4>
                <hr>

                @forelse($listings as $listing)
                    @include('listings.partials._listing_owned', compact('listing'))
                @empty
                    <p>You have no listings.</p>
                @endforelse

                {{ $listings->links() }}
            </div>
        </div>
    </div>
@endsection
