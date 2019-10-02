@if(session()->has('error'))
    @component('layouts.admin.partials.alerts._alerts_component', [
    'type' => 'red-light',
    'link' => session('error_link')
    ])
        {{ session('error') }}
    @endcomponent

@endif

@if(session()->has('warning'))
    @component('layouts.admin.partials.alerts._alerts_component', [
    'type' => 'orange-dark',
    'link' => session('warning_link')
    ])
        {{ session('warning') }}
    @endcomponent

@endif

@if(session()->has('success'))
    @component('layouts.admin.partials.alerts._alerts_component', [
    'type' => 'teal',
    'link' => session('success_link')
    ])
        {{ session('success') }}
    @endcomponent
@endif

@if(session()->has('info'))
    @component('layouts.admin.partials.alerts._alerts_component', [
    'type' => 'blue-light',
    'link' => session('info_link')
    ])
        {{ session('info') }}
    @endcomponent
@endif

@if(session()->has('bulk_error') && count(session('bulk_error')) > 0)
    @include('layouts.admin.partials.alerts._alerts_bulk_component', [
    'type' => 'red-light',
    'alerts' => session('bulk_error')
    ])
@endif

@if(session()->has('bulk_success') && count(session('bulk_success')) > 0)
    @include('layouts.admin.partials.alerts._alerts_bulk_component', [
    'type' => 'teal',
    'alerts' => session('bulk_success')
    ])
@endif
