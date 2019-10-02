<div class="block w-full items-center bg-{{ $type }} text-white text-sm font-semibold px-4 py-4 mb-4 alert fade show"
     role="alert">
    <span class="block sm:inline">{{ $slot }}</span>
    @if(isset($link) && !empty($link))
        <a href="{{ $link }}" class="font-thin">
            {{ session('alert_link_name') }}
        </a>
    @endif
    <button class="h-full w-8 text-white float-right" data-dismiss="alert" type="button" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
