@extends('layouts.admin.default')

@section('title', page_title('Permissions'))

@section('content')
    <div class="flex flex-1 items-center justify-between">
        <h3>Permissions</h3>

        <a href="{{ route('admin.permissions.create') }}"
           class="shadow bg-teal hover:bg-teal-dark text-white font-bold py-2 px-4 no-underline text-sm rounded focus:outline-none focus:shadow-outline">
            Add Permission
        </a>
    </div>
    <hr class="border-b h-1 mb-4">

    <div class="table-responsive mb-8">
        <table class="table table-hover border border-grey text-grey-darkest">
            <thead class="bg-grey">
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->usable ? 'Active' : 'Disabled' }}</td>
                    <td>
                        <div class="text-sm">
                            <a href="{{ route('admin.permissions.edit', $permission) }}"
                               class="block mt-4 no-underline lg:inline-block lg:mt-0 text-teal-dark hover:text-teal-darkest mr-4">
                                Edit
                            </a>
                            <a href="{{ route('admin.permissions.destroy', $permission) }}"
                               class="block mt-4 no-underline lg:inline-block lg:mt-0 text-red hover:text-red-darker mr-4"
                               onclick="event.preventDefault();
                                       document.getElementById('del-permission-{{ $permission->id }}-form').submit();">
                                Delete
                            </a>

                            <!-- Permission Delete Form -->
                            <form id="del-permission-{{ $permission->id }}-form"
                                  action="{{ route('admin.permissions.destroy', $permission) }}"
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

    {{ $permissions->links('admin.vendor.pagination.default') }}
@endsection
