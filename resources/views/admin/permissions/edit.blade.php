@extends('layouts.admin.default')

@section('title', page_title('Edit Permission'))

@section('content')
    <div class="overflow-hidden shadow bg-white border mx-2 mt-1 mb-0 p-5">
        <h4 class="text-lg text-grey-darker">Edit `<em>{{ $permission->name }}</em>` permission</h4>
        <hr class="border-b h-1 mb-4">

        <form action="{{ route('admin.permissions.update', $permission) }}" method="post">
            @csrf
            @method('PUT')

            <div class="md:flex md:items-center mb-6">
                <div class="flex-1">
                    <label class="block text-grey-darker font-bold mb-1 md:mb-0 pr-4" for="name">
                        Name
                    </label>
                    <input
                            class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-teal"
                            id="name"
                            type="text"
                            name="name"
                            placeholder="Permission name"
                            value="{{ old('name', $permission->name) }}" autofocus>

                    @if($errors->has('name'))
                        <p class="text-red text-xs font-bold my-3">{{ $errors->first('name') }}</p>
                    @endif

                    <p class="mt-2 text-grey-dark text-sm">You can leave a space between words.</p>
                </div><!-- /col -->
            </div><!-- /.flex -->

            <div class="md:flex md:items-center mb-6">
                <label class="flex-1 block text-grey-darker font-bold">
                    <input name="usable"
                           class="mr-2 leading-tight"
                           type="checkbox"
                           value="1"
                            {{ old('usable', $permission->usable) == 1 ? ' checked' : '' }}>
                    <span class="text-sm">
                        Active
                    </span>
                </label>
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
