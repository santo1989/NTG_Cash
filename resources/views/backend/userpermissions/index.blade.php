<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Create Permission
    </x-slot>

    {{-- <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Permission </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
            <li class="breadcrumb-item active">Create Permission</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot> --}}


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
   <div class="container">
        <h1>User Permissions</h1>

        <form action="{{ route('user_permissions.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="user_id">User:</label>
                <select class="form-control" id="user_id" name="user_id">
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="permission_id">Permission:</label>
                <select class="form-control" id="permission_id" name="permission_id">
                    @foreach ($permissions as $permission)
                        <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-outline-info">Assign Permission</button>
        </form>

        <hr>
        <h2>Assigned Permissions</h2>

        <table class="table" id="dataTableSample">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Permission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @foreach ($user->permissions as $permission)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <form action="{{ route('user_permissions.destroy',['user_permission'=>$user->id]) }}"
                                method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="permission_id" value="{{ $permission->id }}">
                                    <button type="submit" class="btn btn-outline-danger">Revoke</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>


</x-backend.layouts.master>
