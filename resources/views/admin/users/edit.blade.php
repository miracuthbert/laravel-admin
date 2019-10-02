@extends('layouts.admin.default')

@section('title', page_title('Edit User'))

@section('content')
    <div class="overflow-hidden shadow bg-white border mx-2 mt-1 mb-6 p-5">
        <h4 class="text-lg text-grey-darker">{{ $user->name }}</h4>
        <p class="mt-2 text-grey-dark">Manage user's details and roles.</p>
        <hr class="border-b h-1 mb-4">

        <form action="{{ route('admin.users.roles.store', $user) }}" method="post">
            @csrf

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
                            class="datetimepicker bg-grey-lighter appearance-none border-2 border-grey-lighter rounded w-full py-2 px-4 text-grey-darker leading-tight focus:outline-none focus:bg-white focus:border-teal"
                            id="expires_at"
                            type="text"
                            name="expires_at"
                            placeholder="date role expires at"
                            value="{{ old('expires_at') }}">

                    @if($errors->has('expires_at'))
                        <p class="text-red text-xs font-bold my-3">{{ $errors->first('expires_at') }}</p>
                    @endif

                    <p class="mt-2 text-grey-dark text-sm">You can leave field as empty and change it later.</p>
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

    <div class="overflow-hidden shadow bg-white border mx-2 mt-1 mb-0 p-5">
        <h5 class="text-xl mb-3">Roles</h5>

        @if($user->roles->count())
            <div class="table-responsive mb-8">
                <table class="table table-hover table-borderless text-grey-darkest">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Expires</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->roles as $role)
                        <tr>
                            <td>
                                {{ $role->name }}
                                @if(($ancestors = $role->ancestors)->count())
                                    {{ ' - (' . implode(' / ', $ancestors->pluck('name')->toArray()) . ')' }}
                                @endif
                            </td>
                            <td>{{ $role->roleable->expires_at }}</td>
                            <td>
                                @if(!$role->roleable->expires_at || now()->lt(optional($role->roleable)->expires_at))
                                    <a href="{{ route('admin.users.roles.edit', [$user, $role]) }}"
                                       class="block mt-4 no-underline lg:inline-block lg:mt-0 text-teal-dark hover:text-teal-darkest mr-4">
                                        Edit
                                    </a>
                                    <a href="#"
                                       class="block mt-4 no-underline lg:inline-block lg:mt-0 text-red hover:text-red-darker mr-4"
                                       onclick="event.preventDefault();
                                               document.getElementById('rev-role-{{ $role->id }}-form').submit();">
                                        Revoke
                                    </a>

                                    <!-- Role revoke Form -->
                                    <form id="rev-role-{{ $role->id }}-form"
                                          action="{{ route('admin.users.roles.destroy', [$user, $role]) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                @else
                                    <div class="text-red-light mt-4 lg:mt-0">Role expired</div>
                                @endif
                            </td>
                        </tr><!-- /tr -->
                    @endforeach
                    </tbody><!-- /tbody -->
                </table><!-- /table -->
            </div><!-- /.table-responsive -->
        @else
            <p class="py-2">No roles found.</p>
        @endif
    </div><!-- /card -->
@endsection
