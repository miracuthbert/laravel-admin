<label class="block text-grey-darker font-bold mb-1 md:mb-0 pr-4" for="parent_id">
    Parent
</label>
<div class="relative">
    <select
            class="block appearance-none bg-grey-lighter border-2 border-grey-lighter rounded w-full py-3 px-4 pr-8 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-teal"
            id="parent_id"
            name="parent_id">
        <option value="" selected></option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}"
                    {{ old('parent_id', $parent_id ?? null) == $role->id ? ' selected' : '' }}>
                {{ $role->name }}
            </option>
        @endforeach
    </select>

    <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
             viewBox="0 0 20 20">
            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
        </svg>
    </div>
</div><!-- /.relative -->

@if($errors->has('parent_id'))
    <p class="text-red text-xs font-bold my-3">{{ $errors->first('parent_id') }}</p>
@endif
