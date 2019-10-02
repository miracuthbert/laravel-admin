<div class="flex bg-teal border-b border-grey-light items-center">
    <div class="w-full max-w-screen-xl mx-auto p-3 px-6">
        <nav class="lg:flex items-center -mx-6">
            <div class="flex w-full lg:w-1/6 pl-6 pr-6 lg:pr-8">
                <div class="block md:hidden lg:hidden mr-1">
                    <button type="button" data-toggle="sidebar" data-target="#sidebar"
                            class="sidebar-toggler flex items-center px-2 py-2 rounded text-teal-lighter hover:text-white focus:border focus:border-white"
                            title="sidebar">
                        <i class="icon-menu"></i>
                    </button>
                </div><!-- /sidebar-toggler -->
                <div class="flex items-center flex-no-shrink text-white mr-auto">
                    <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/>
                    </svg>
                    <a href="{{ route('home') }}" class="text-white no-underline font-semibold text-xl tracking-tight">
                        {{ config('app.name') }}
                    </a>
                </div><!-- /brand -->
                <div class="block lg:hidden ml-2 md:ml-auto">
                    <button type="button" data-toggle="sidebar" data-target="#navbarSupportedContent"
                            class="navbar-toggler flex items-center px-3 py-2 border rounded text-teal-lighter border-teal-light hover:text-white hover:border-white">
                        <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>
                                Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                        </svg>
                    </button>
                </div><!-- /navbar-toggler -->
            </div><!-- /nav-brand -->
            <div class="w-full lg:flex flex-grow lg:items-center lg:w-5/6 pl-6 pr-6 lg:pl-4 lg:pr-1 hidden"
                 id="navbarSupportedContent">
                <div class="w-full lg:w-auto lg:flex-grow text-sm">
                    <a href="{{ route('admin.dashboard') }}"
                       class="block mt-4 lg:inline-block lg:mt-0 no-underline text-white hover:text-teal-lighter mr-4">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                       class="block mt-4 no-underline lg:inline-block lg:mt-0 text-white hover:text-teal-lighter mr-4">
                        Users
                    </a>
                </div>
                <div class="w-full lg:w-1/4 lg:items-end text-sm lg:text-right">
                    <a href="{{ route('account.index') }}"
                       class="block mt-4 no-underline lg:inline-block lg:mt-0 text-white hover:text-teal-lighter mr-4">
                        My Account
                    </a>
                    <a href="#"
                       class="block mt-4 no-underline lg:inline-block lg:mt-0 text-white hover:text-teal-lighter mr-4"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    @include('layouts.partials.forms._logout')
                </div>
            </div><!-- /nav-wrapper -->
        </nav><!-- /nav -->
    </div><!-- /.w -->
</div><!-- /.flex -->
