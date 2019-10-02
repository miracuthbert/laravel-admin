@extends('layouts.admin.default')

@section('title', page_title('Users'))

@section('content')
    <div class="flex flex-1 items-center justify-between">
        <h3>Users</h3>

        <div class="flex">
            <a href="{{ route('admin.users.create') }}"
               class="shadow bg-teal hover:bg-teal-dark text-white font-bold py-2 px-4 no-underline text-sm rounded focus:outline-none focus:shadow-outline">
                Add User
            </a>
            <!-- Filters -->
            <div>&nbsp;</div>
        </div>
    </div>
    <hr class="border-b h-1 mb-4">

    <div class="flex mb-4">
        <div class="w-full h-8 md\:align-middle">
            <users-search/>
        </div>
    </div>
    <hr class="border-b h-1 mb-4">

    <div class="table-responsive mb-8">
        <table class="table table-hover border border-grey text-grey-darkest">
            <thead class="bg-grey">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Verified</th>
                <th scope="col">Roles</th>
                <th scope="col">Joined</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="{{ return_if($user->hasVerifiedEmail(), 'text-green font-semibold') ?? 'text-red-light' }}">
                        {{ $user->hasVerifiedEmail() ? 'Verified' : 'Not verified' }}
                    </td>
                    <td>{{ $user->roles_count }}</td>
                    <td>{{ $user->created_at->diffForHumans() }}</td>
                    <td>
                        <div class="text-sm">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="block mt-4 no-underline lg:inline-block lg:mt-0 text-teal-dark hover:text-teal-darkest mr-4">
                                Edit
                            </a>

                            <!-- Uncomment code block below to enable user deletion -->
                            {{--<a href="{{ route('admin.users.destroy', $user) }}"--}}
                            {{--class="block mt-4 no-underline lg:inline-block lg:mt-0 text-red hover:text-red-darker mr-4"--}}
                            {{--onclick="event.preventDefault();--}}
                            {{--document.getElementById('del-user-{{ $user->id }}-form').submit();">--}}
                            {{--Delete--}}
                            {{--</a>--}}

                            {{--<!-- Category Delete Form -->--}}
                            {{--<form id="del-user-{{ $user->id }}-form"--}}
                            {{--action="{{ route('admin.users.destroy', $user) }}"--}}
                            {{--method="POST" style="display: none;">--}}
                            {{--@csrf--}}
                            {{--@method('DELETE')--}}
                            {{--</form>--}}
                        </div>
                    </td>
                </tr><!-- /tr -->
            @endforeach
            </tbody><!-- /tbody -->
        </table><!-- /table -->
    </div><!-- /.table-responsive -->

    {{ $users->links('admin.vendor.pagination.default') }}
@endsection
