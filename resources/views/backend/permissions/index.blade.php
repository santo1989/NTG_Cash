<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Permission List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Permission </x-slot>
            <li class="breadcrumb-item"><a href="{{ route('permissions.index') }}">Permission</a></li>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>

    <section class="content">
        <div class="container-fluid">

            @if (session('message'))
                <div class="alert alert-success">
                    <span class="close" data-dismiss="alert">&times;</span>
                    <strong>{{ session('message') }}.</strong>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href={{ route('permissions.create') }}>Create</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- permission Table goes here --}}

                            <table id="datatablesSimple" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Sl#</th>
                                        <th>Name</th>
                                        <th>Actions</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php $sl=0 @endphp
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ ++$sl }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>
                                                <a class="btn btn-primary"
                                                    href={{ route('permissions.edit', ['permission' => $permission->id]) }}>Edit</a>
                                                <form action={{ route('permissions.destroy', $permission->id) }}
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</x-backend.layouts.master>
