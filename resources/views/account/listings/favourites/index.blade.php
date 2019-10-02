@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Favourite Listings</h4>
                <hr>

                @forelse($listings as $listing)
                    @include('listings.partials._listing_favourite', compact('listing'))
                @empty
                    <p>No favourite listings.</p>
                @endforelse

                {{ $listings->links() }}
            </div>
        </div>
    </div>
@endsection
