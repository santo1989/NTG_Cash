<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Edit Permission
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Permission </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
            <li class="breadcrumb-item active">Edit Permission</li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- <form action="{{ route('permissions.update') }}" method="post"> --}}
    <form action="{{ route('permissions.update', ['permission' => $permission->id]) }}" method="post">
        <div>
            @csrf
            @method('patch')


            <div class="row m-4">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>permission Name</label>
                        <input type="text" class="form-control" placeholder="Enter permission Name" name="name"
                            value="{{ old('name', $permission->name) }}">
                    </div>
                </div>

            </div>
            <button type="submit" class="btn btn-primary" style="margin-left: 33px">Save</button>
        </div>
    </form>


</x-backend.layouts.master>
