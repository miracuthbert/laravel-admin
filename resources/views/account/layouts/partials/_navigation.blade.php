<ul class="nav flex-column nav-pills">
    <li class="nav-item">
        <a class="nav-link{{ return_if(on_page('account.index'), ' active') }}" href="{{ route('account.index') }}">
            Account overview
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ return_if(on_page('account.profile.index'), ' active') }}"
           href="{{ route('account.profile.index') }}">
            Profile
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link{{ return_if(on_page('account.password.index'), ' active') }}"
           href="{{ route('account.password.index') }}">
            Change password
        </a>
    </li>
</ul>