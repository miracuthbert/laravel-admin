@extends('account.dashboard.layouts.default')

@section('dashboard.content')
    <div class="card">
        <div class="card-header">
            <h4>Listing Payment</h4>

            Confirm and pay for listing or <a href="{{ route('account.listings.edit', $listing) }}">continue editing</a>.
        </div>
        <div class="card-body">
            <div class="media my-4 mt-md-0">
                <div class="media-body">
                    <h5>
                        {{ $listing->title }}
                    </h5>
                    <p> In
                        @if($listing->area->ancestors->count())
                            <span class="text-muted">
                                {{  implode(' > ', $listing->area->ancestors->pluck('name')->toArray()) }} &gt;
                            </span>
                        @endif
                        {{ $listing->area->name }}
                    </p>
                    <p>
                        Under
                        @if($listing->category->ancestors->count())
                            <span class="text-muted">
                                {{  implode(' > ', $listing->category->ancestors->pluck('name')->toArray()) }} &gt;
                            </span>
                        @endif
                        {{ $listing->category->name }}
                    </p>
                </div>
            </div>
            <hr>

            @if($listing->cost() == 0)
                <form method="POST" action="{{ route('account.listings.payments.update', $listing) }}">
                    @csrf

                    @method('PUT')

                    <div class="form-group">
                        <p class="form-text">There is nothing for you to pay.</p>

                        <button type="submit" name="checkout" class="btn btn-primary" value="1">
                            Complete
                        </button>
                    </div>
                </form>
            @else
                <form method="POST" action="{{ route('account.listings.payments.store', $listing) }}"
                      id="listing-checkout-form">
                    @csrf

                    <div class="form-group">
                        <div class="d-flex justify-content-between align-content-center">
                            <aside>
                                <h3>{{ $listing->formattedCost() }}</h3>
                            </aside>

                            <button type="submit" class="btn btn-primary" id="listing-checkout-pay">
                                Pay
                            </button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script>
        let handler = StripeCheckout.configure({
            key: '{{ config('services.stripe.key') }}',
            image: 'https://stripe.com/img/documentation/checkout/marketplace.png',
            locale: 'auto',
            token: function (token) {   // You can access the token ID with `token.id`
                let form = $('#listing-checkout-form')

                $('#listing-checkout-pay').prop('disabled', true)

                $('<input>').attr({
                    type: 'hidden',
                    name: 'stripeToken',
                    value: token.id,
                }).appendTo(form)

                form.submit();
            }
        })

        $('#listing-checkout-pay').click(function (e) {
            // Open Checkout with further options:
            handler.open({
                name: '{{ $listing->title }}',
                description: "{{ config('app.name') }} - Ad listing fee",
                amount: {{ $listing->cost() }},
                currency: '{{ config('classifieds.money.currency') }}',
                key: '{{ config('services.stripe.key') }}',
                email: '{{ $listing->user->email }}'
            })

            e.preventDefault();
        })

        // Close Checkout on page navigation:
        window.addEventListener('popstate', function () {
            handler.close();
        });
    </script>
@endpush
