<x-backend.layouts.master>
    <x-slot name="pageTitle">
        Issue Entry
    </x-slot>

    <x-slot name='breadCrumb'>
        <x-backend.layouts.elements.breadcrumb>
            <x-slot name="pageHeader"> Issue Entry </x-slot>
        </x-backend.layouts.elements.breadcrumb>
    </x-slot>


    <x-backend.layouts.elements.errors />
    <form action="{{ route('issue_entries.store') }}" method="post" enctype="multipart/form-data">
        <div>
            @csrf
            @method('post')

            {{-- Issue Riser Info --}}
            <fieldset>
                <legend class="text-center">Issue Riser Info:</legend>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            @php
                                $divisions = App\Models\Division::all();
                            @endphp
                            <label>Division</label>
                            <select name="division_id" id="division_id" class="form-select">
                                <option value="">Select Division</option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">
                                        {{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Company</label>
                            <select name="company_id" id="company_id" class="form-select">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="form-group">
                            <label>Department</label>
                            <select name="department_id" id="department_id" class="form-select">
                            </select>
                        </div>


                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <x-backend.form.input name="issue_reporter" type="text" label="Issue Reporter" />
                        </div>
                    </div>
                </div>
            </fieldset>
            <br>
            <hr />
            {{-- Issue Riser Info --}}
            {{-- Issue Info --}}
            <fieldset>
                <legend class="text-center">Issue Info:</legend>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-3">
                        <x-backend.form.input name="assign_date" type="date" label="Issue Date"
                            min="{{ date('Y-m-d') }}" />
                    </div>


                    <div class="col-md-3">
                        <label>Issue Type</label>
                        <select name="issue_type" id="issue_type" class="form-select">
                            <option value="Self">Self</option>
                            <option value="Vendor">Vendor</option>
                        </select>

                    </div>
                    <div class="col-md-3">
                        <label>Issue Priority</label>
                        <select name="issue_priority" id="issue_priority" class="form-select">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>

                        </select>
                    </div>
                    <div class="col-md-3">
                        <x-backend.form.input name="due_date" type="date" label="Delivery Date" />
                    </div>
                </div>
            </fieldset>
            <br>
            <hr />
            {{-- Issue  Info --}}
            {{-- Issue Entry --}}
            <fieldset>
                <legend class="text-center">Issue Entry:</legend>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-3">
                        <x-backend.form.input name="subject" type="text" label="Issue subject" />
                    </div>

                    <div class="col-md-6">
                        <label>Issue Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>


                    </div>
                    <div class="col-md-3">
                        <x-backend.form.input name="issue_attachment" type="file" label="Issue Attachment" />
                    </div>

                </div>
            </fieldset>
            <br>
            <hr />
            {{-- Issue Entry --}}
            {{-- Vandor Attachment --}}
            <fieldset id="Vendor_div" style="display: none;">
                <legend class="text-center">Vandor Info Entry:</legend>
                <br>
                <hr />
                <div class="row">


                    <div class="col-md-2">

                        <x-backend.form.input name="issue_handed_over_to_vendor" type="text"
                            label="Vendor Infomation" />

                    </div>

                    <div class="col-md-3">

                        <x-backend.form.input name="issue_vendor_phage" type="text" label="Vendor Phage of Issue" />

                    </div>
                    <div class="col-md-2">
                        <x-backend.form.input name="vendor_handed_over_date_to_department" type="date"
                            label="Vendor Delivery Date to Department" />
                    </div>
                    <div class="col-md-5">
                        <label>Issue Handed Over Comment</label>
                        <textarea name="vendor_handed_over_comment" id="vendor_handed_over_comment" class="form-control"></textarea>
                    </div>


                </div>
            </fieldset>

            <br>
            <hr />
            <fieldset>
                <legend class="text-center">Issue Closing:</legend>
                <br>
                <hr />
                <div class="row">
                    <div class="col-md-3">
                        <label>Issue Status</label>
                        <select name="issue_status" id="issue_status" class="form-select">
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-3" id="issue_closed_date_div" style="display: none;">
                        <x-backend.form.input name="issue_closed_date" type="date" label="Issue Closed Date" />
                    </div>



                    <div class="col-md-6">
                        <label>Issue Related Comment</label>
                        <textarea name="issue_comment" id="issue_comment" class="form-control"></textarea>
                    </div>

                </div>
            </fieldset>

            <button type="submit" class="btn btn-outline-info btn-sm"><i class="bi bi-save-fill"></i>Save</button>
        </div>
    </form>
    <div class="pb-3">
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#issue_type').change(function() {
                if ($(this).val() == 'Vendor') {
                    $('#Vendor_div').show();
                } else {
                    $('#Vendor_div').hide();
                }
            });
        });
        $(document).ready(function() {
            $('#issue_status').change(function() {
                if ($(this).val() == 'Close') {
                    $('#issue_closed_date_div').show();
                } else {
                    $('#issue_closed_date_div').hide();
                }
            });
        });
        $(document).ready(function() {
            $('input[name="assign_date"]').change(function() {
                var minDate = new Date($(this).val());
                minDate.setDate(minDate.getDate() + 1); // add one day to avoid same day
                var today = new Date();
                if (minDate < today) {
                    minDate = today;
                }
                var minDateStr = minDate.toISOString().split('T')[0];
                $('input[name="due_date"]').attr('min', minDateStr);
                // $('input[name="issue_closed_date"]').attr('min', minDateStr);
            });
        });


        $(document).ready(function() {
            $('#division_id').on('change', function() {
                var divisionId = $(this).val();

                if (divisionId) {
                    $.ajax({
                        url: '/get-company-designation/' + divisionId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            const companySelect = $('#company_id');
                            const designationSelect = $('#designation_id');

                            companySelect.empty();
                            companySelect.append('<option value="">Select Company</option>');
                            $.each(data.company, function(index, company) {
                                companySelect.append(
                                    `<option value="${company.id}">${company.name}</option>`
                                );
                            });

                            designationSelect.empty();
                            designationSelect.append(
                                '<option value="">Select Designation</option>');
                            $.each(data.designations, function(index, designation) {
                                designationSelect.append(
                                    `<option value="${designation.id}">${designation.name}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('Select a division first for company and designation name.');
                }
            });
        });

        $(document).ready(function() {
            $('#company_id').on('change', function() {
                var company_id = $(this).val();

                if (company_id) {
                    $.ajax({
                        url: '/get-department/' + company_id,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            console.log(data);
                            const companySelect = $('#department_id');

                            companySelect.empty();
                            companySelect.append('<option value="">Select Department</option>');
                            $.each(data.departments, function(index, departments) {
                                companySelect.append(
                                    `<option value="${departments.id}">${departments.name}</option>`
                                );
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error(error);
                        }
                    });
                } else {
                    alert('Select a Company first for Department name.');
                }
            });
        });
    </script>


</x-backend.layouts.master>
