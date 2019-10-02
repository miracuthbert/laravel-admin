<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('layouts.admin.partials._head')
    </head>
    <body>
        <div id="app">
            <div class="mx-auto bg-grey-lighter font-sans text-grey-darkest">
                <div class="min-h-screen flex flex-col">
                    @include('layouts.admin.partials._header')

                    <div class="flex flex-1">
                        @include('layouts.admin.partials._sidebar')

                        <main class="w-full flex-1 lg:max-w-full md:max-w-md p-4">
                            @include('layouts.admin.partials.alerts._alerts')

                            @yield('content')
                        </main>
                    </div><!-- /.flex -->
                </div><!-- /screen -->
            </div><!-- /.container -->
        </div><!-- /#app -->
    </body><!-- /body -->

    @include('layouts.admin.partials._scripts')
</html>
