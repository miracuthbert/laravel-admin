@extends('layouts.admin.default')

@section('title', page_title('Edit User Role'))

@section('content')
    <div class="overflow-hidden shadow bg-white border mx-2 mt-1 mb-6 p-5">
        <h4 class="text-lg text-grey-darker">Update {{ $user->name }}, <em>{{ $role->name }}</em> role</h4>
        <hr class="border-b h-1 mb-4">

        <form action="{{ route('admin.users.roles.update', [$user, $role]) }}" method="post">
            @csrf
            @method('PUT')

            <div class="md:flex flex-wrap mb-6">
                <div class="flex-1">
                    <label class="block text-grey-darker font-bold mb-1 md:mb-0 pr-4">
                        Role
                    </label>
                    <p class="text-grey-darker text-sm leading-tight font-semibold py-2">
                        {{ $role->name }}
                    </p>
                </div><!-- /col -->
            </div><!-- /.flex -->

            <div class="md:flex md:items-center mb-6">
                <div class="flex-1">
                    <label class="block text-grey-darker font-bold mb-1 md:mb-0 pr-4" for="expires_at">
                        Role expires at
                    </label>
                    <input
                            class="datetimepicker bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-teal"
                            id="expires_at"
                            type="text"
                            name="expires_at"
                            placeholder="date role expires at"
                            value="{{ old('expires_at', $role->roleable->expires_at) }}">

                    @if($errors->has('expires_at'))
                        <p class="text-red text-xs font-bold my-3">{{ $errors->first('expires_at') }}</p>
                    @endif

                    <p class="mt-2 text-grey-dark text-sm">You can leave field as empty or set a date.</p>
                </div><!-- /col -->
            </div><!-- /.flex -->

            <div class="md:flex md:items-center">
                <div class="flex-1">
                    <button class="shadow bg-teal hover:bg-teal-dark focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                            type="submit">
                        Save
                    </button>
                </div>
            </div>
        </form><!-- /form -->
    </div><!-- /card -->
@endsection