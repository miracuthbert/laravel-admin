@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                @include('account.dashboard.layouts.partials._navigation')
            </div>
            <div class="col-md-9">
                @yield('dashboard.content')
            </div>
        </div>
    </div>
@endsection
