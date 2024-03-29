<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.partials._head')
    </head>
    <body>
        <div id="app">
            @include('layouts.partials._navigation')

            <main class="py-4">
                <div class="container">
                    @include('layouts.partials.alerts._alerts')
                </div>

                @yield('content')
            </main>
        </div>
    </body>

    @include('layouts.partials._scripts')
</html>
