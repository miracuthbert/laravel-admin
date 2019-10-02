@extends('layouts.admin.default')

@section('title', page_title('Add User'))

@section('content')
    <div class="overflow-hidden shadow bg-white border mx-2 mt-1 mb-0 p-5">
        <h4 class="text-lg text-grey-darker">Add new user</h4>
        <p class="mt-2 text-grey-dark">An invitation link will be emailed to the user to complete registration.</p>
        <hr class="border-b h-1 mb-4">

        <form action="{{ route('admin.users.store') }}" method="post">
            @csrf

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
                            placeholder="name"
                            value="{{ old('name') }}" autofocus>

                    @if($errors->has('name'))
                        <p class="text-red text-xs font-bold my-3">{{ $errors->first('name') }}</p>
                    @endif
                </div><!-- /col -->
            </div><!-- /.flex -->

            <div class="md:flex md:items-center mb-6">
                <div class="flex-1">
                    <label class="block text-grey-darker font-bold mb-1 md:mb-0 pr-4" for="email">
                        Email
                    </label>
                    <input
                            class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-teal"
                            id="email"
                            type="email"
                            name="email"
                            placeholder="email"
                            value="{{ old('email') }}">

                    @if($errors->has('email'))
                        <p class="text-red text-xs font-bold my-3">{{ $errors->first('email') }}</p>
                    @endif
                </div><!-- /col -->
            </div><!-- /.flex -->

            <div class="md:flex flex-wrap mb-6">
                <div class="flex-1">
                    @include('admin.roles.partials.forms._roles')
                </div><!-- /col -->
            </div><!-- /.flex -->

            <div class="md:flex md:items-center mb-6">
                <div class="flex-1">
                    <label class="block text-grey-darker font-bold mb-1 md:mb-0 pr-4" for="expires_at">
                        Role expires at
                    </label>
                    <input
                            class="bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-teal"
                            id="expires_at"
                            type="text"
                            name="expires_at"
                            placeholder="date role expires at"
                            value="{{ old('expires_at') }}">

                    @if($errors->has('expires_at'))
                        <p class="text-red text-xs font-bold my-3">{{ $errors->first('expires_at') }}</p>
                    @endif
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
