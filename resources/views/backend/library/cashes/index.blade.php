<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Cash
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> </x-slot>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xl-12">
                    <div class="card" style="background-color: #40c47c;">
                        {{-- style="width: 100vw; overflow-x: scroll;" --}}

                        <div class="card-header" style="background: rgba(0, 0, 0, 0.4); color: #f1f1f1; ">

                            <form method="GET" action="{{ route('cashes.index') }}">
                                @csrf
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <table
                                                class="table table-borderless table-responsive text-center text-light font-weight-bold">
                                                <tr>


                                                    <div class="form-group">
                                                        <td>Incentive Category:</td>
                                                        <td>
                                                            <select name="inc_category" id="inc_category"
                                                                class="form-control">
                                                                <option value="">Select Inc Category</option>
                                                                <option value="ACA">ACA</option>
                                                                <option value="SCA">SCA</option>
                                                                <option value="NME">NME</option>
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td>Company:</td>
                                                        <td>
                                                            <select name="company_id" id="company_id"
                                                                class="form-control">
                                                                <option value=""
                                                                    style="background-color: rgba(0, 0, 0, 0.5)">Select
                                                                    Company</option>
                                                                <option value="TIL">Tosrifa Industries Ltd</option>
                                                                <option value="FAL">Fashion Asia Ltd</option>
                                                                <option value="NCL">Northern Corporation Ltd.
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td>Date:</td>
                                                        <td>
                                                            <input type="date" name="entry_date_start"
                                                                id="entry_date_start" class="form-control">
                                                        </td>
                                                        <td>-</td>
                                                        <td>
                                                            <input type="date" name="entry_date_end"
                                                                id="entry_date_end" class="form-control">
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td>Export LC No.:</td>
                                                        <td>
                                                            <input type="text" name="export_lc_number"
                                                                id="export_lc_number" class="form-control">
                                                        </td>
                                                    </div>
                                                    <div class="form-group">
                                                        <td>Job No.:</td>
                                                        <td>
                                                            <input type="text" name="job_number" id="job_number"
                                                                class="form-control">
                                                        </td>
                                                    </div>
                                                    <td>
                                                        <button class="btn btn-outline-info btn-sm"
                                                            onclick="validateForm()"><i class="fa fa-search"></i>
                                                            Search</button>

                                                    </td>

                                                    <td>
                                                        <a href="{{ route('cashes.index') }}"
                                                            class="btn btn-outline-danger btn-sm"><i
                                                                class="fa fa-refresh"></i> Reset</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </form>


                        </div>

                    </div>

                    <div class="row pt-1">
                        <div class="col-md-6 col-sm-12">
                            <a type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                data-bs-target="#CashEntryModal"><i class="fa fa-plus" aria-hidden="true"></i>
                                Create
                            </a>
                            <a type="button" id="delete-selected" class="btn btn-outline-danger"><i class="fa fa-trash"
                                    aria-hidden="true"></i> Delete Selected</a>
                        </div>
                        <div class="col-md-6 col-sm-12 text-md-end">
                            @if ($search_cashes == !null)
                                <form method="GET" action="{{ route('cashes.index') }}">
                                    @csrf

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="form-group" id="hide_div">
                                                <label for="export_format">Export Format:</label>
                                                <select name="export_format" id="export_format" class="form-control">
                                                    <option value="xlsx">Excel (XLS)</option>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-outline-info">
                                                <i class="fa fa-file-excel" aria-hidden="true"></i> Export
                                            </button>
                                        </div>
                                    </div>

                                </form>
                            @endif
                        </div>
                    </div>


                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    {{-- Table goes here --}}
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>
                                    {{-- multi-delete icon --}}
                                    <i class="fa fa-trash" aria-hidden="true"></i>

                                </th>
                                <th>Sl#</th>
                                <th>Date</th>
                                <th>Company</th>
                                <th>Inc Category</th>
                                <th>Job No</th>
                                <th>Export LC No.</th>
                                <th>LC Date</th>
                                <th>Replace LC No</th>
                                <th>Remarks</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cashes as $cash)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="checkbox" name="selected_cashes[]"
                                            value="{{ $cash->id }}">
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-outline-info" data-toggle="modal"
                                            data-target="#exampleModalCenter{{ $cash->id }}">
                                            {{ $cash->serial_number }}
                                        </button>
                                    </td>
                                    <td>{{ $cash->date ? \Carbon\Carbon::parse($cash->date)->format('d-M-Y') : '' }}
                                    </td>
                                    <td>{{ $cash->company_id }}</td>
                                    <td>{{ $cash->inc_category }}</td>
                                    <td>{{ $cash->job_number }}</td>
                                    <td>{{ $cash->export_lc_number }}</td>
                                    <td>{{ $cash->lc_date ? \Carbon\Carbon::parse($cash->lc_date)->format('d-M-Y') : '' }}
                                    </td>
                                    <td>{{ $cash->replace_lc_number }}</td>
                                    <td>{{ $cash->remarks }}</td>
                                    <td>
                                        <a type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                            data-bs-target="#CashEditModal{{ $cash->id }}">Edit</a>

                                        <form id="delete-form-{{ $cash->id }}"
                                            action="{{ route('cashes.destroy', $cash->id) }}" method="POST"
                                            class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-outline-danger delete-button"
                                                data-cash-id="{{ $cash->id }}">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">
                                        <div class="alert alert-danger">
                                            No Data Found
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    {{ $cashes->links() }}







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

    {{-- start model for show Data Entry --}}




    <div class="modal fade" id="CashEntryModal" data-bs-backdrop="static" tabindex="-1"
        aria-labelledby="CashEntryModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="min-width:90%;">
            <div class="modal-content" style="background-color: rgba(0,0,0,0.5); min-width:90%;">
                <div class="modal-header" style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                    <h5 class="modal-title text-center" id="CashEntryModal"> Data Entry</h5>
                    <button type="button" class="btn btn-light btn-close" data-bs-dismiss="modal"
                        aria-label="Close" style="background-color: white; border-color: white; color: black;"
                        onmouseover="this.classList.add('btn-danger')"
                        onmouseout="this.classList.remove('btn-danger')"></button>

                </div>
                <div class="modal-body" style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                    <!-- Your x-guest-layout code here -->

                    <div class="container-fluid justify-content-center"
                        style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                        <div class="row justify-content-between">
                            <div class="col-md-12">
                                <div>
                                    <div class=" p-4 p-md-5">
                                        <!-- Validation Errors -->
                                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                        <form method="POST" action="{{ route('cashes.store') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            {{-- row-1 start --}}
                                            <div class="row justify-content-between">
                                                {{-- Company start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="company_id" :value="__('Company')" class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <select name="company_id" id="company_id"
                                                                    class="form-control" >
                                                                    <option value=""
                                                                        style="background-color: rgba(0, 0, 0, 0.5)">
                                                                        Select Company</option>
                                                                    <option value="TIL">Tosrifa Industris Ltd
                                                                    </option>
                                                                    <option value="FAL">Fashion Asia
                                                                        Ltd</option>
                                                                    <option value="NCL">Northern Corporation Ltd.
                                                                    </option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- Company end --}}

                                                {{-- INC Category start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="inc_category" :value="__('Inc Category')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <select name="inc_category" id="inc_category"
                                                                    class="form-control">
                                                                    <option value="">Select Inc Category</option>
                                                                    <option value="ACA">ACA</option>
                                                                    <option value="SCA">SCA</option>
                                                                    <option value="NME">NME</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- INC Category end --}}


                                                {{-- % of Claim start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="claim_percentage" :value="__('% of Claim')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <select name="claim_percentage" id="claim_percentage"
                                                                    class="form-control">
                                                                    <option value="">Select % of Claim</option>
                                                                    <option value="1%">1%</option>
                                                                    <option value="4%">4%</option>
                                                                    <option value="6%">6%</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- % of Claim end --}}
                                                {{-- Job Number start --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="job_number" :value="__('Job Number')" class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="job_number" id="job_number"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>



                                                </div>
                                                {{-- Job Number end --}}
                                            </div>
                                            {{-- row-1 end --}}
                                            {{-- row-2 start --}}
                                            <div class="row justify-content-between">
                                                {{-- export_lc_number start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="export_lc_number" :value="__('Export L/C No')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="export_lc_number" id="export_lc_number"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- export_lc_number end --}}

                                                {{-- replace_lc_number start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="replace_lc_number" :value="__('Replace L/C No')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="replace_lc_number"
                                                                    id="replace_lc_number" class="form-control"
                                                                     autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- replace_lc_number end --}}


                                                {{-- lc_date start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="lc_date" :value="__('L/C Date')" class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="lc_date" id="lc_date"
                                                                    class="form-control" type="date" 
                                                                    autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- lc_date end --}}
                                                {{-- lc_value start --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="lc_value" :value="__('L/C Value')" class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="lc_value" id="lc_value"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>



                                                </div>
                                                {{-- lc_value end --}}
                                            </div>
                                            {{-- row-2 end --}}
                                            {{-- row-3 start --}}
                                            <div class="row justify-content-between">
                                                {{-- invoice_value start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="invoice_value" :value="__('Invoice Value')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="invoice_value" id="invoice_value"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- invoice_value end --}}

                                                {{-- realized_amount start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="realized_amount" :value="__('Realized Amount')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="realized_amount" id="realized_amount"
                                                                    type="number" class="form-control" 
                                                                    autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- realized_amount end --}}


                                                {{-- claim_amount start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="claim_percentage" :value="__('Claim Amount')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="claim_amount" id="claim_amount"
                                                                    type="number" class="form-control" 
                                                                    autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- claim_amount end --}}
                                                {{-- claim_amount_bdt start --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="claim_amount_bdt" :value="__('Claim Amount BDT')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="claim_amount_bdt" id="claim_amount_bdt"
                                                                    type="number" class="form-control" 
                                                                    autofocus />
                                                            </div>

                                                        </div>
                                                    </div>



                                                </div>
                                                {{-- claim_amount_bdt end --}}
                                            </div>
                                            {{-- row-3 end --}}
                                            {{-- row-4 start --}}
                                            <div class="row justify-content-between">
                                                {{-- last_proceed_receive_date start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="last_proceed_receive_date" :value="__('Last Proceed Receive Date')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="last_proceed_receive_date"
                                                                    id="last_proceed_receive_date" type="date"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- last_proceed_receive_date end --}}

                                                {{-- last_claim_submission_date start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="last_claim_submission_date" :value="__('Last Claim Submission Date')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="last_claim_submission_date"
                                                                    id="last_claim_submission_date" type="date"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- last_claim_submission_date end --}}


                                                {{-- bank_apply_date start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="bank_apply_date" :value="__(' Bank Apply Date')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="bank_apply_date" id="bank_apply_date"
                                                                    type="date" class="form-control" 
                                                                    autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{--  bank_apply_date end --}}
                                                {{-- claim_submission_date start --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="claim_submission_date" :value="__('Claim Submission Date')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="claim_submission_date"
                                                                    id="claim_submission_date" type="date"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>



                                                </div>
                                                {{-- claim_submission_date end --}}
                                            </div>
                                            {{-- row-4 end --}}
                                            {{-- row-5 start --}}
                                            <div class="row justify-content-between">
                                                {{-- bank_reference start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="bank_reference" :value="__('Bank Reference')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="bank_reference" id="bank_reference"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- bank_reference end --}}

                                                {{-- auditor_reference start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="auditor_reference" :value="__('Auditor Reference')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="auditor_reference"
                                                                    id="auditor_reference" class="form-control"
                                                                     autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- auditor_reference end --}}


                                                {{-- discrepancy start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="discrepancy" :value="__('Discrepancy Claim')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="discrepancy" id="discrepancy"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- discrepancy end --}}
                                                {{-- certificate_amount start --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="certificate_amount" :value="__('Certificate Amount')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="certificate_amount"
                                                                    id="certificate_amount" type="number"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>



                                                </div>
                                                {{-- certificate_amount end --}}
                                            </div>
                                            {{-- row-5 end --}}
                                            {{-- row-6 start --}}
                                            <div class="row justify-content-between">
                                                {{-- certificate_received_date start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="certificate_received_date" :value="__(' Certificate Received Date')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="certificate_received_date"
                                                                    id="certificate_received_date" type="date"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- certificate_received_date end --}}

                                                {{-- bangladesh_bank_reference start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="bangladesh_bank_reference" :value="__('Bangladesh Bank Reference')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="bangladesh_bank_reference"
                                                                    id="bangladesh_bank_reference"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- bangladesh_bank_reference end --}}


                                                {{-- date start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="date" :value="__('Date')" class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="date" id="date" type="date"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- date end --}}
                                                {{-- cash_received_amount_bdt start --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="cash_received_amount_bdt" :value="__('Cash Received Amount BDT')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="cash_received_amount_bdt"
                                                                    id="cash_received_amount_bdt" type="number"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>



                                                </div>
                                                {{-- cash_received_amount_bdt end --}}
                                            </div>
                                            {{-- row-6 end --}}
                                            {{-- row-7 start --}}
                                            <div class="row justify-content-between">
                                                {{-- cash_received_date start  --}}
                                                <div class="col-md-3">


                                                    <div class="mt-3">

                                                        <x-label for="cash_received_date" :value="__('Cash Received Date')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="cash_received_date"
                                                                    id="cash_received_date" type="date"
                                                                    class="form-control"  autofocus />
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                                {{-- cash_received_date end --}}

                                                {{-- page_number start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="page_number" :value="__('Page Number')"
                                                            class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <x-input name="page_number" id="page_number"
                                                                    type="number" class="form-control" 
                                                                    autofocus />
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- page_number end --}}


                                                {{-- remarks start --}}
                                                <div class="col-md-3">

                                                    <div class="mt-3 ">
                                                        <x-label for="remarks" :value="__('Remarks')" class="ml-2 " />

                                                        <div class="row">
                                                            <div class="col-12">
                                                                <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control"></textarea>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- remarks end --}}
                                                {{-- submit start --}}
                                                <div class="col-md-3">

                                                    <div style="margin-top:50px;">

                                                        <button type="submit"
                                                            class="btn btn-outline-light ml-2 mx-auto d-block">Create</button>
                                                    </div>

                                                </div>
                                                {{-- submit end --}}
                                            </div>
                                            {{-- row-7 end --}}

                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>




                </div>
            </div>
        </div>
    </div>



    {{-- end model for Data Entry --}}

    {{-- start model for Data Edit --}}
    @foreach ($cashes as $cash)
        <div class="modal fade" id="CashEditModal{{ $cash->id }}" tabindex="-1"
            aria-labelledby="CashEditModal{{ $cash->id }}Label" aria-hidden="true" data-bs-backdrop="static"
            data-bs-keyboard="false">
            <div class="modal-dialog modal-xl" style="min-width:90%;">
                <div class="modal-content" style="background-color: rgba(0,0,0,0.5); min-width:90%;">
                    <div class="modal-header" style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                        <h5 class="modal-title text-center" id="CashEditModalLabel">Data Edit</h5>
                        <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="modal-body" style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                        <!-- Your x-guest-layout code here -->

                        {{-- Add a form element with an ID for the submit button --}}


                        <div class="container-fluid justify-content-center"
                            style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                            <div class="row justify-content-between">
                                <div class="col-md-12">
                                    <div>
                                        <div class=" p-4 p-md-5">
                                            <!-- Validation Errors -->
                                            <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                            <form method="POST" action="{{ route('cashes.update', $cash) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                {{-- Rest of your form elements --}}
                                                {{-- row-1 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- Company start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="company_id" :value="__('Company')"
                                                                class="ml-2 " />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <select name="company_id" id="company_id"
                                                                        class="form-control" >
                                                                        <option value=""
                                                                            style="background-color: rgba(0, 0, 0, 0.5)">
                                                                            Select Company</option>
                                                                        <option value="TIL"
                                                                            {{ $cash->company_id == 'TIL' ? 'selected' : '' }}>
                                                                            Tosrifa Industris Ltd</option>
                                                                        <option value="FAL"
                                                                            {{ $cash->company_id == 'FAL' ? 'selected' : '' }}>
                                                                            Fashion Asia Ltd</option>
                                                                        <option value="NCL"
                                                                            {{ $cash->company_id == 'NCL' ? 'selected' : '' }}>
                                                                            Northern Corporation Ltd.</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Company end --}}

                                                    {{-- INC Category start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="inc_category" :value="__('Inc Category')"
                                                                class="ml-2 " />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <select name="inc_category" id="inc_category"
                                                                        class="form-control">
                                                                        <option value="">Select Inc Category
                                                                        </option>
                                                                        <option value="ACA"
                                                                            {{ $cash->inc_category == 'ACA' ? 'selected' : '' }}>
                                                                            ACA</option>
                                                                        <option value="SCA"
                                                                            {{ $cash->inc_category == 'SCA' ? 'selected' : '' }}>
                                                                            SCA</option>
                                                                        <option value="NME"
                                                                            {{ $cash->inc_category == 'NME' ? 'selected' : '' }}>
                                                                            NME</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- INC Category end --}}

                                                    {{-- % of Claim start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="claim_percentage" :value="__('% of Claim')"
                                                                class="ml-2 " />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <select name="claim_percentage"
                                                                        id="claim_percentage" class="form-control">
                                                                        <option value="">Select % of Claim
                                                                        </option>
                                                                        <option value="1%"
                                                                            {{ $cash->claim_percentage == '1%' ? 'selected' : '' }}>
                                                                            1%</option>
                                                                        <option value="4%"
                                                                            {{ $cash->claim_percentage == '4%' ? 'selected' : '' }}>
                                                                            4%</option>
                                                                        <option value="6%"
                                                                            {{ $cash->claim_percentage == '6%' ? 'selected' : '' }}>
                                                                            6%</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- % of Claim end --}}

                                                    {{-- Job Number start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="job_number" :value="__('Job Number')"
                                                                class="ml-2 " />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="job_number" id="job_number"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->job_number" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Job Number end --}}

                                                </div>

                                                {{-- row-1 end --}}
                                                {{-- row-2 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- export_lc_number start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="export_lc_number" :value="__('Export L/C No')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="export_lc_number"
                                                                        id="export_lc_number" class="form-control"
                                                                         autofocus :value="$cash->export_lc_number" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- export_lc_number end --}}

                                                    {{-- replace_lc_number start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="replace_lc_number" :value="__('Replace L/C No')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="replace_lc_number"
                                                                        id="replace_lc_number" class="form-control"
                                                                         autofocus :value="$cash->replace_lc_number" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- replace_lc_number end --}}

                                                    {{-- lc_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="lc_date" :value="__('L/C Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="lc_date" id="lc_date"
                                                                        class="form-control" type="date" 
                                                                        autofocus :value="$cash->lc_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- lc_date end --}}

                                                    {{-- lc_value start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="lc_value" :value="__('L/C Value')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="lc_value" id="lc_value"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->lc_value" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- lc_value end --}}
                                                </div>

                                                {{-- row-2 end --}}
                                                {{-- row-3 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- invoice_value start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="invoice_value" :value="__('Invoice Value')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="invoice_value" id="invoice_value"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->invoice_value" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- invoice_value end --}}

                                                    {{-- realized_amount start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="realized_amount" :value="__('Realized Amount')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="realized_amount"
                                                                        id="realized_amount" type="number"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->realized_amount" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- realized_amount end --}}

                                                    {{-- claim_amount start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="claim_amount" :value="__('Claim Amount')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="claim_amount" id="claim_amount"
                                                                        type="number" class="form-control" 
                                                                        autofocus :value="$cash->claim_amount" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- claim_amount end --}}

                                                    {{-- claim_amount_bdt start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="claim_amount_bdt" :value="__('Claim Amount BDT')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="claim_amount_bdt"
                                                                        id="claim_amount_bdt" type="number"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->claim_amount_bdt" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- claim_amount_bdt end --}}
                                                </div>

                                                {{-- row-3 end --}}
                                                {{-- row-4 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- last_proceed_receive_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="last_proceed_receive_date" :value="__('Last Proceed Receive Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="last_proceed_receive_date"
                                                                        id="last_proceed_receive_date" type="date"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->last_proceed_receive_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- last_proceed_receive_date end --}}

                                                    {{-- last_claim_submission_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="last_claim_submission_date"
                                                                :value="__('Last Claim Submission Date')" class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="last_claim_submission_date"
                                                                        id="last_claim_submission_date" type="date"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->last_claim_submission_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- last_claim_submission_date end --}}

                                                    {{-- bank_apply_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="bank_apply_date" :value="__('Bank Apply Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="bank_apply_date"
                                                                        id="bank_apply_date" type="date"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->bank_apply_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- bank_apply_date end --}}

                                                    {{-- claim_submission_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="claim_submission_date" :value="__('Claim Submission Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="claim_submission_date"
                                                                        id="claim_submission_date" type="date"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->claim_submission_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- claim_submission_date end --}}
                                                </div>

                                                {{-- row-4 end --}}
                                                {{-- row-5 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- bank_reference start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="bank_reference" :value="__('Bank Reference')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="bank_reference" id="bank_reference"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->bank_reference" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- bank_reference end --}}

                                                    {{-- auditor_reference start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="auditor_reference" :value="__('Auditor Reference')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="auditor_reference"
                                                                        id="auditor_reference" class="form-control"
                                                                         autofocus :value="$cash->auditor_reference" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- auditor_reference end --}}

                                                    {{-- discrepancy start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="discrepancy" :value="__('Discrepancy Claim')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="discrepancy" id="discrepancy"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->discrepancy" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- discrepancy end --}}

                                                    {{-- certificate_amount start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="certificate_amount" :value="__('Certificate Amount')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="certificate_amount"
                                                                        id="certificate_amount" type="number"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->certificate_amount" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- certificate_amount end --}}
                                                </div>

                                                {{-- row-5 end --}}
                                                {{-- row-6 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- certificate_received_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="certificate_received_date" :value="__('Certificate Received Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="certificate_received_date"
                                                                        id="certificate_received_date" type="date"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->certificate_received_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- certificate_received_date end --}}

                                                    {{-- bangladesh_bank_reference start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="bangladesh_bank_reference" :value="__('Bangladesh Bank Reference')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="bangladesh_bank_reference"
                                                                        id="bangladesh_bank_reference"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->bangladesh_bank_reference" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- bangladesh_bank_reference end --}}

                                                    {{-- date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="date" :value="__('Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="date" id="date"
                                                                        type="date" class="form-control" 
                                                                        autofocus :value="$cash->date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- date end --}}

                                                    {{-- cash_received_amount_bdt start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="cash_received_amount_bdt" :value="__('Cash Received Amount BDT')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="cash_received_amount_bdt"
                                                                        id="cash_received_amount_bdt" type="number"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->cash_received_amount_bdt" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- cash_received_amount_bdt end --}}
                                                </div>

                                                {{-- row-6 end --}}
                                                {{-- row-7 start --}}
                                                <div class="row justify-content-between">
                                                    {{-- cash_received_date start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="cash_received_date" :value="__('Cash Received Date')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="cash_received_date"
                                                                        id="cash_received_date" type="date"
                                                                        class="form-control"  autofocus
                                                                        :value="$cash->cash_received_date" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- cash_received_date end --}}

                                                    {{-- page_number start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="page_number" :value="__('Page Number')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <x-input name="page_number" id="page_number"
                                                                        type="number" class="form-control" 
                                                                        autofocus :value="$cash->page_number" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- page_number end --}}

                                                    {{-- remarks start --}}
                                                    <div class="col-md-3">
                                                        <div class="mt-3">
                                                            <x-label for="remarks" :value="__('Remarks')"
                                                                class="ml-2" />
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <textarea name="remarks" id="remarks" cols="30" rows="2" class="form-control">{{ $cash->remarks }}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- remarks end --}}

                                                    {{-- submit start --}}
                                                    <div class="col-md-3">
                                                        <div style="margin-top: 50px;">
                                                            <button type="submit"
                                                                class="btn btn-outline-light ml-2 mx-auto d-block">Update</button>


                                                        </div>
                                                    </div>
                                                    {{-- submit end --}}
                                                </div>

                                                {{-- row-7 end --}}

                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- end model for Data Edit --}}

    {{-- start model for Data details --}}

    @foreach ($cashes as $cash)
        <div class="modal fade" id="exampleModalCenter{{ $cash->id }}" tabindex="-1" data-bs-backdrop="static"
            aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" style="min-width:90%;">
                <div class="modal-content" style="background-color: rgba(0,0,0,0.5); min-width:90%;">
                    <div class="modal-header" style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                        <h5 class="modal-title text-center" id="registerModalLabel"> Data Show of
                            {{ $cash->serial_number }}</h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">X</button>

                    </div>
                    <div class="modal-body" style="background: rgba(0, 0, 0, 0.5); color: #f1f1f1; min-width:90%;">
                        <div class="container-fluid">
                            <table class="table responsive-table table-bordered border-light text-dark bg-light">
                                <tr>
                                    <th>Company:</th>
                                    <td>{{ $cash->company_id }}</td>
                                    <th>Inc Category:</th>
                                    <td>{{ $cash->inc_category }}</td>
                                </tr>
                                <tr>
                                    <th>Claim Percentage:</th>
                                    <td>{{ $cash->claim_percentage }}</td>
                                    <th>Job Number:</th>
                                    <td>{{ $cash->job_number }}</td>
                                </tr>
                                <tr>
                                    <th>Export LC Number:</th>
                                    <td>{{ $cash->export_lc_number }}</td>
                                    <th>Replace LC Number:</th>
                                    <td>{{ $cash->replace_lc_number }}</td>
                                </tr>
                                <tr>
                                    <th>LC Date:</th>
                                    <td>{{ $cash->lc_date ? \Carbon\Carbon::parse($cash->lc_date)->format('d-M-Y') : '' }}
                                    </td>
                                    <th>LC Value:</th>
                                    <td>{{ $cash->lc_value }}</td>
                                </tr>
                                <tr>
                                    <th>Invoice Value:</th>
                                    <td>{{ $cash->invoice_value }}</td>
                                    <th>Realized Amount:</th>
                                    <td>{{ number_format($cash->realized_amount, 2, ',', ',') }}</td>
                                </tr>
                                <tr>
                                    <th>Claim Amount:</th>
                                    <td>{{ number_format($cash->claim_amount, 2, ',', ',') }}</td>
                                    <th>Claim Amount BDT:</th>
                                    <td>{{ number_format($cash->claim_amount_bdt, 2, ',', ',') }}</td>
                                </tr>
                                <tr>
                                    <th>Last Proceed Receive Date:</th>
                                    <td>{{ $cash->last_proceed_receive_date ? \Carbon\Carbon::parse($cash->last_proceed_receive_date)->format('d-M-Y') : '' }}
                                    </td>
                                    <th>Last Claim Submission Date:</th>
                                    <td>{{ $cash->last_claim_submission_date ? \Carbon\Carbon::parse($cash->last_claim_submission_date)->format('d-M-Y') : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bank Apply Date:</th>
                                    <td>{{ $cash->bank_apply_date ? \Carbon\Carbon::parse($cash->bank_apply_date)->format('d-M-Y') : '' }}
                                    </td>
                                    <th>Claim Submission Date:</th>
                                    <td>
                                        {{ $cash->claim_submission_date ? \Carbon\Carbon::parse($cash->claim_submission_date)->format('d-M-Y') : '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Bank Reference:</th>
                                    <td>{{ $cash->bank_reference }}</td>
                                    <th>Auditor Reference:</th>
                                    <td>{{ $cash->auditor_reference }}</td>
                                </tr>
                                <tr>
                                    <th>Discrepancy:</th>
                                    <td>{{ $cash->discrepancy }}</td>
                                    <th>Certificate Amount:</th>
                                    <td>{{ number_format($cash->certificate_amount, 2, ',', ',') }}</td>
                                </tr>
                                <tr>
                                    <th>Certificate Received Date:</th>
                                    <td>
                                        {{ $cash->certificate_received_date ? \Carbon\Carbon::parse($cash->certificate_received_date)->format('d-M-Y') : '' }}

                                    </td>
                                    <th>Bangladesh Bank Reference:</th>
                                    <td>{{ $cash->bangladesh_bank_reference }}</td>
                                </tr>
                                <tr>
                                    <th>Date:</th>
                                    <td>{{ $cash->date ? \Carbon\Carbon::parse($cash->date)->format('d-M-Y') : '' }}
                                    </td>
                                    <th>Cash Received Amount BDT:</th>
                                    <td>{{ number_format($cash->cash_received_amount_bdt, 2, ',', ',') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Cash Received Date:</th>
                                    <td>
                                        {{ $cash->cash_received_date ? \Carbon\Carbon::parse($cash->cash_received_date)->format('d-M-Y') : '' }}
                                    </td>
                                    <th>Page Number:</th>
                                    <td>{{ $cash->page_number }}</td>
                                </tr>
                                <tr>
                                    <th>Remarks:</th>
                                    <td colspan="3">{{ $cash->remarks }}</td>
                                </tr>
                            </table>
                        </div>


                    </div>
                    <div class="modal-footer">

                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#CashEditModal{{ $cash->id }}" data-bs-dismiss="modal" onclick="closePreviousModal() )">Edit</a> --}}

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                            data-bs-target="#CashEditModal{{ $cash->id }}" data-bs-dismiss="modal"
                            onclick="closeAndShowModal('{{ $cash->id }}')">Edit</a>





                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- End model for Data details --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // Single Delete
            $('.delete-button').on('click', function() {
                var cashId = $(this).data('cash-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteCash(cashId);
                    }
                });
            });

            // Delete Selected
            $('#delete-selected').on('click', function() {
                var selectedCashes = $('input[name="selected_cashes[]"]:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedCashes.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete them all!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            deleteCashes(selectedCashes);
                        }
                    });
                } else {
                    Swal.fire('No data Selected', 'Please select at least one data to delete.', 'warning');
                }
            });

            function deleteCash(cashId) {
                var deleteForm = $('#delete-form-' + cashId);
                deleteForm.submit();
            }

            function deleteCashes(cashIds) {
                var totalDeleted = 0;
                var deletedCount = 0;

                cashIds.forEach(function(cashId) {
                    var deleteForm = $('#delete-form-' + cashId);
                    var csrfToken = deleteForm.find('input[name="_token"]').val();

                    $.ajax({
                        url: deleteForm.attr('action'),
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: csrfToken
                        },
                        success: function() {
                            deletedCount++;
                            if (deletedCount === totalDeleted) {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'Total ' + deletedCount +
                                        ' cash(es) have been deleted.',
                                    icon: 'success'
                                }).then(() => {
                                    location.reload(); // Reload the page
                                });
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'An error occurred while deleting the cash(es).',
                                'error');
                        }
                    });

                    totalDeleted++;
                });
            }
        });

        $(document).ready(function() {
            $("#hide_div").hide();
        });

        // function closePreviousModal() {
        //     // Find the previous modal using its ID and trigger the click event on the "Close" button
        //     var previousModal = document.querySelector('.modal.show');
        //     var closeButton = previousModal.querySelector('[data-bs-dismiss="modal"]');
        //     closeButton.click();
        // }

        function closeAndShowModal(cashId) {
            closePreviousModal(); // Close previous modal

            // Show the new modal using its ID
            var newModal = document.querySelector('#CashEditModal' + cashId);
            var modalInstance = new bootstrap.Modal(newModal);
            modalInstance.show();
        }

        function closePreviousModal() {
            // Find the previous modal using its class and trigger the click event on the "Close" button
            var previousModal = document.querySelector('.modal.show');
            if (previousModal) { // Check if previousModal exists
                var closeButton = previousModal.querySelector('[data-dismiss="modal"]');
                if (closeButton) { // Check if closeButton exists
                    if (typeof closeButton.click === 'function') { // Check if closeButton.click is a function
                        closeButton.click();
                    }
                }
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validateForm() {
            var incCategory = document.getElementById("inc_category").value;
            var companyId = document.getElementById("company_id").value;
            var entryDateStart = document.getElementById("entry_date_start").value;
            var entryDateEnd = document.getElementById("entry_date_end").value;
            var exportLcNumber = document.getElementById("export_lc_number").value;
            var jobNumber = document.getElementById("job_number").value;

            if (incCategory === "" && companyId === "" && entryDateStart === "" && entryDateEnd === "" && exportLcNumber ===
                "" && jobNumber === "") {
                Swal.fire({
                    title: "Warning",
                    text: "Please fill in at least one field to search",
                    icon: "warning",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "OK"
                });
            } else {
                // Submit the form or perform further processing
            }
        }
    </script>
</x-backend.layouts.master>
