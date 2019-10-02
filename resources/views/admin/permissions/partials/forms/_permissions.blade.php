<label class="block text-grey-darker font-bold mb-1 md:mb-3 pr-4">
    Permissions
</label>
<div class="mb-4" id="permissions">
    <div class="w-full mb-4">
        <label class="block text-grey-darker font-bold mb-1 md:mb-0">
            <input class="mr-2 leading-tight checkbox-toggle"
                   type="checkbox"
                   data-target="#permissions">
            <span class="text-sm">
                Assign all permissions
            </span>
        </label>
    </div>
    @foreach($permissions->chunk($chunk = 3) as $permissionsGroup)
        <div class="md:flex md:items-start mb-6">
            @foreach($permissionsGroup as $permission)
                <label class="flex-1 block text-grey-darker mb-1 md:mb-0">
                    <input name="permissions[{{ $permission->id }}]"
                           class="mr-2 leading-tight"
                           type="checkbox"
                           data-parent="#permissions"
                           value="{{ $permission->id }}"
                            {{ in_array($permission->id, old('permissions', $permission_ids ?? [])) ? ' checked' : '' }}>
                    <span class="text-sm">
                        {{ $permission->name }}
                    </span>
                </label>

                @if($loop->count < $chunk && $loop->last)
                    <label class="flex-1 block">&nbsp;</label>
                @endif
            @endforeach
        </div><!-- /.flex -->
    @endforeach
</div>

@if($errors->has('permission_id'))
    <p class="text-red text-xs font-bold my-3">{{ $errors->first('permission_id') }}</p>
@endif
