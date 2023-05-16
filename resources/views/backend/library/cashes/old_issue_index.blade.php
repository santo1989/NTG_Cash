<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Issue List
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Issue List </x-slot>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />



    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xl-12">
                    <div class="card" style="width: 80vw; overflow-x: scroll;
                    ">
                        <div class="card-header">
                            <x-backend.form.anchor :href="route('issue_entries.create')" type="create" />
                            <a href="{{ route('issue_entries.index') }}" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-sync-alt"></i> Issue List</a>

                                
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            {{-- issue_entry Table goes here --}}
                            @if ($issue_entries == null || count($issue_entries) == 0)
                                <div class="alert alert-danger">
                                    No Data Found
                                </div>
                            @else
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl#</th>
                                            <th>Issue Raise Date</th>
                                            <th>Subject</th>
                                            <th>From Department</th>
                                            <th>Issue Raiser</th>
                                            <th>Possible Delivery Date to Client</th>
                                            <th>Departmental Responsible Person</th>
                                            <th>Days Needed</th>
                                            {{-- <th>Actions</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $sl=0 @endphp
                                        @foreach ($issue_entries as $issue_entry)
                                            @php
                                                $date1 = new DateTime($issue_entry->due_date);
                                                $date2 = new DateTime($issue_entry->issue_closed_date);
                                                $diff = $date2->diff($date1)->format('%a');
                                                $status = $issue_entry->issue_status;
                                            @endphp
                                            <tr
                                                @if ($diff <= 1 && $status != 'Close') style="background-color: red; color: white;" @endif>
                                                <td><button type="button" class="btn btn-outline-info"
                                                        data-toggle="modal"
                                                        data-target="#exampleModalCenter{{ $issue_entry->id }}">
                                                        {{ ++$sl }}
                                                    </button></td>
                                                <td>{{ $issue_entry->assign_date }}</td>
                                                <td>{{ $issue_entry->subject }}</td>
                                                <td> {{ $issue_entry->department->name }},
                                                    {{ $issue_entry->company->name }}
                                                </td>
                                                <td>{{ $issue_entry->issue_reporter }}</td>
                                                <td>{{ $issue_entry->due_date }}</td>
                                                @php
                                                    if ($issue_entry->issue_assign_to != null) {
                                                        $issue_assign_to = App\Models\User::find($issue_entry->issue_assign_to)->name;
                                                    }
                                                @endphp
                                                <td>
                                                    @isset($issue_assign_to)
                                                        {{ $issue_assign_to }}
                                                    @endisset
                                                   
                                                </td>
                                                <td>{{ $diff }}</td>
                                                {{-- <td>
                                                    <x-backend.form.anchor :href="route('issue_entries.edit', [
                                                        'issue_entry' => $issue_entry->id,
                                                    ])" type="edit" />
                                                    <form action={{ route('issue_entries.destroy', $issue_entry->id) }}
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger my-1 mx-1 inline btn-sm"
                                                            type="submit">Delete</button>
                                                    </form>
                                                </td> --}}
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

    {{-- start model for show details --}}
    @foreach ($issue_entries as $issue_entry)
        <div class="modal fade" id="exampleModalCenter{{ $issue_entry->id }}" tabindex="-1" role="dialog"
            data-bs-backdrop="static" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Issue Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table responsive-table">
                            <tr>
                                <th>Division ID:</th>
                                <td>{{ $issue_entry->division->name }}</td>
                            </tr>
                            <tr>
                                <th>Company ID:</th>
                                <td>{{ $issue_entry->company->name }}</td>
                            </tr>
                            <tr>
                                <th>Department ID:</th>
                                <td>{{ $issue_entry->department->name }}</td>
                            </tr>
                            <tr>
                                <th>Issue Reporter:</th>
                                <td>{{ $issue_entry->issue_reporter }}</td>
                            </tr>
                            <tr>
                                <th>Assign Date:</th>
                                <td>{{ $issue_entry->assign_date }}</td>
                            </tr>
                            <tr>
                                <th>Issue Type:</th>
                                <td>{{ $issue_entry->issue_type }}</td>
                            </tr>
                            <tr>
                                <th>Issue Priority:</th>
                                <td>{{ $issue_entry->priority }}</td>
                            </tr>
                            <tr>
                                <th>Delivery Date:</th>
                                <td>{{ $issue_entry->due_date }}</td>
                            </tr>
                            <tr>
                                <th>Subject:</th>
                                <td>{{ $issue_entry->subject }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $issue_entry->description }}</td>
                            </tr>
                            <tr>
                                <th>Issue Handed Over to Vendor:</th>
                                <td>{{ $issue_entry->issue_handed_over_to_vendor }}</td>
                            </tr>
                            <tr>
                                <th>Issue Vendor Phage:</th>
                                <td>{{ $issue_entry->issue_vendor_phage }}</td>
                            </tr>
                            <tr>
                                <th>Vendor Handed Over Date to Department:</th>
                                <td>{{ $issue_entry->vendor_handed_over_date_to_department }}</td>
                            </tr>
                            <tr>
                                <th>Vendor Handed Over Comment:</th>
                                <td>{{ $issue_entry->vendor_handed_over_comment }}</td>
                            </tr>
                            <tr>
                                <th>Issue Status:</th>
                                <td>{{ $issue_entry->issue_status }}</td>
                            </tr>
                            <tr>
                                <th>Issue Closed Date:</th>
                                <td>{{ $issue_entry->issue_closed_date }}</td>
                            </tr>
                            <tr>
                                <th>Issue Assign To:</th>
                                @php
                                    $user = App\Models\User::where('id', $issue_entry->issue_assign_to)->first();
                                @endphp
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Old User List:</th>
                                <td>
                                    @php
                                        $old_users = json_decode($issue_entry->old_issue_assign_to_list);
                                    @endphp

                                    @if ($old_users)
                                        @foreach ($old_users as $user_id)
                                            @php
                                                $user = App\Models\User::find($user_id);
                                            @endphp
                                            @isset($user)
                                                {{ $user->name }} <br>
                                            @endisset
                                        @endforeach
                                    @endif


                            </tr>
                            <tr>
                                <th>Issue Comment:</th>
                                <td>{{ $issue_entry->issue_comment }}</td>
                            </tr>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    {{-- end model for show details --}}

    {{-- start model for transfer user details --}}

   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable({
            paging: true,
            ordering: true,
            info: true,
            searching: true
        });
    });
</script>

    @endif




    {{-- end model for transfer user details --}}

</x-backend.layouts.master>
