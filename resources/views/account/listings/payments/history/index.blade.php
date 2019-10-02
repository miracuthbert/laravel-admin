@extends('account.dashboard.layouts.default')

@section('dashboard.content')
    <div class="card">
        <div class="card-header">Listings Payments History</div>
        <div class="card-body">
            @if($payments->count())
                <p class="text-muted">History of all listing payments made.</p>

                <div class="table-responsive mb-3">
                    <table class="table table-hover table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Listing</th>
                            <th scope="col">Category</th>
                            <th scope="col">Price</th>
                            <th scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>
                                    <a href="{{ route('area.listings.show', [$payment->listing->area, $payment->listing]) }}">
                                        {{ $payment->listing->title }}
                                    </a>
                                </td>
                                <td>{{ optional($payment->listing->category)->name }}</td>
                                <td>{{ $payment->formattedPrice }}</td>
                                <td>{{ optional($payment->created_at)->toDateString() }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <th scope="row">Lifetime Payments Total</th>
                            <th scope="row">{{ $lifetimePaymentsTotal }}</th>
                            <td></td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                {{ $payments->links() }}
            @else
                <p>No payment history.</p>
            @endif
        </div>
    </div>
@endsection