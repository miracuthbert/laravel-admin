@extends('layouts.admin.default')

@section('title', page_title('Roles'))

@section('content')
    <div class="flex flex-1 items-center justify-between">
        <h3>Roles</h3>

        <a href="{{ route('admin.roles.create') }}"
           class="shadow bg-teal hover:bg-teal-dark text-white font-bold py-2 px-4 no-underline text-sm rounded focus:outline-none focus:shadow-outline">
            Add Role
        </a>
    </div>
    <hr class="border-b h-1 mb-4">

    <div class="table-responsive mb-8">
        <table class="table table-hover border border-grey text-grey-darkest">
            <thead class="bg-grey">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Users</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{!! str_repeat('&nbsp;&nbsp;', $role->depth) !!}{{ $role->name }}</td>
                    <td>{{ $role->usable ? 'Active' : 'Disabled' }}</td>
                    <td>{{ $role->users_count }}</td>
                    <td>
                        <div class="text-sm">
                            <a href="{{ route('admin.roles.edit', $role) }}"
                               class="block mt-4 no-underline lg:inline-block lg:mt-0 text-teal-dark hover:text-teal-darkest mr-4">
                                Edit
                            </a>
                            <a href="{{ route('admin.roles.destroy', $role) }}"
                               class="block mt-4 no-underline lg:inline-block lg:mt-0 text-red hover:text-red-darker mr-4"
                               onclick="event.preventDefault();
                                       document.getElementById('del-role-{{ $role->id }}-form').submit();">
                                Delete
                            </a>

                            <!-- Role Delete Form -->
                            <form id="del-role-{{ $role->id }}-form"
                                  action="{{ route('admin.roles.destroy', $role) }}"
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </td>
                </tr><!-- /tr -->
            @endforeach
            </tbody><!-- /tbody -->
        </table><!-- /table -->
    </div><!-- /.table-responsive -->
@endsection
