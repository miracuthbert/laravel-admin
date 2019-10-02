<aside id="sidebar" class="bg-white w-1/2 md:w-1/6 lg:w-1/6 border-r-2 border-grey-light hidden md:block lg:block">
    <!-- Dashboard Link -->
    <ul class="list-reset flex flex-col border-b-2">
        <li class="{{ return_if(on_page('admin.dashboard'), ' bg-grey-light border-l-4 border-teal') ?? ' hover:bg-grey-light' }}">
            <a href="{{ route('admin.dashboard') }}"
               class="block w-full h-full py-3 px-4 text-center lg:text-left text-sm font-semibold hover:text-teal no-underline{{ return_if(on_page('admin.dashboard'), ' text-teal') ?? ' text-teal-darker' }}">
                <i class="block text-xl md:text-base py-2 lg:py-0 icon-speedometer lg:float-left mx-auto lg:mx-2"></i>
                Dashboard
            </a>
        </li>
    </ul>
    <!-- Users Links -->
    <ul class="list-reset flex flex-col">
        <li class="text-center lg:text-left">
            <h5 class="text-xs font-semibold leading-tight text-grey-dark px-4 py-3">USERS &amp; ACCESS CONTROL</h5>
        </li>
        <li class="{{ return_if(on_page('admin.users.index'), ' bg-grey-light border-l-4 border-teal') ?? ' hover:bg-grey-light' }}">
            <a href="{{ route('admin.users.index') }}"
               class="block w-full h-full py-3 px-4 text-center lg:text-left text-sm font-semibold hover:text-teal no-underline{{ return_if(on_page('admin.users.index'), ' text-teal') ?? ' text-teal-darker' }}">
                <i class="block text-xl md:text-base py-2 lg:py-0 icon-people lg:float-left mx-auto lg:mx-2"></i>
                Users
            </a>
        </li>
        <li class="{{ return_if(on_page('admin.permissions.index'), ' bg-grey-light border-l-4 border-teal') ?? ' hover:bg-grey-light' }}">
            <a href="{{ route('admin.permissions.index') }}"
               class="block w-full h-full py-3 px-4 text-center lg:text-left text-sm font-semibold hover:text-teal no-underline{{ return_if(on_page('admin.permissions.index'), ' text-teal') ?? ' text-teal-darker' }}">
                <i class="block text-xl md:text-base py-2 lg:py-0 icon-flag lg:float-left mx-auto lg:mx-2"></i>
                Permissions
            </a>
        </li>
        <li class="{{ return_if(on_page('admin.roles.index'), ' bg-grey-light border-l-4 border-teal') ?? ' hover:bg-grey-light' }}">
            <a href="{{ route('admin.roles.index') }}"
               class="block w-full h-full py-3 px-4 text-center lg:text-left text-sm font-semibold hover:text-teal no-underline{{ return_if(on_page('admin.roles.index'), ' text-teal') ?? ' text-teal-darker' }}">
                <i class="block text-xl md:text-base py-2 lg:py-0 icon-shield lg:float-left mx-auto lg:mx-2"></i>
                Roles
            </a>
        </li>
    </ul>
</aside><!-- /.sidebar -->