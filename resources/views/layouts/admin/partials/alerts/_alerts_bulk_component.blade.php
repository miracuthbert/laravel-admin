<div class="block w-full items-center bg-{{ $type }} text-white text-sm font-semibold px-4 py-4 mb-4 alert fade show"
     role="alert">
    <ul>
        @foreach($alerts as $alert)
            <li>{{ $alert }}</li>
        @endforeach
    </ul>
    <button class="h-full w-8 text-white float-right" data-dismiss="alert" type="button" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
