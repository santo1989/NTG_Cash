<?php

namespace App\Http\Controllers;

use App\Models\Cash;
use App\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;

class CashController extends Controller
{
    

    public function index()
    {
        $cashesCollection = Cash::latest();
        $search_cashes = null; // Initialize the variable

        // Check if the inc_category field is selected
        if (request('inc_category')) {
            $cashesCollection = $cashesCollection->where('inc_category', request('inc_category'));
            $search_cashes = $cashesCollection->get();
            session(['search_cashes' => $search_cashes]);
        }

        // Check if the company_id field is selected
        if (request('company_id')) {
            $cashesCollection = $cashesCollection->where('company_id', request('company_id'));
            $search_cashes = $cashesCollection->get();
            session(['search_cashes' => $search_cashes]);
        }

        // Check if the entry_date fields are filled
        if (request('entry_date_start') && request('entry_date_end')) {
            $cashesCollection = $cashesCollection->whereBetween('date', [
                request('entry_date_start'),
                request('entry_date_end')
            ]);
            $search_cashes = $cashesCollection->get();
            session(['search_cashes' => $search_cashes]);
        }

        // Check if the export_lc_number field is filled
        if (request('export_lc_number')) {
            $cashesCollection = $cashesCollection->where('export_lc_number', request('export_lc_number'));
            $search_cashes = $cashesCollection->get();
            session(['search_cashes' => $search_cashes]);
        }

        // Check if the job_number field is filled
        if (request('job_number')) {
            $cashesCollection = $cashesCollection->where('job_number', request('job_number'));
            $search_cashes = $cashesCollection->get();
            session(['search_cashes' => $search_cashes]);
        }

        $cashes = $cashesCollection->paginate(10);

        // Check if export format is requested
        $format = strtolower(request('export_format'));

        if ($format === 'xlsx') {
            // Store the necessary values in the session
            session(['export_format' => $format]);

            // Retrieve the values from the session
            $format = session('export_format');
            $search_cashes = session('search_cashes');

            if ($search_cashes == null) {
                return redirect()->route('cashes.index')->withErrors('First search the data then export');
            } else {
                $data = compact('search_cashes');
                // Generate the view content based on the requested format
                $viewContent = View::make('backend.library.cashes.export', $data)->render();

                // Set appropriate headers for the file download
                $filename = Auth::user()->name . '_' . Carbon::now()->format('Y_m_d') . '_'.time().'.xls';
                $headers = [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename="' . $filename . '"',
                    'Content-Transfer-Encoding' => 'binary',
                    'Cache-Control' => 'must-revalidate',
                    'Pragma' => 'public',
                    'Content-Length' => strlen($viewContent)
                ];

                // Use the "binary" option in response to ensure the file is downloaded correctly
                return response()->make($viewContent, 200, $headers);
            }
        }

        return view('backend.library.cashes.index', compact('cashes', 'search_cashes'));
    }




    public function create()
    {
        
        $cashes = Cash::all();
        return view('backend.library.cashes.create', compact('cashes'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_id' => 'nullable',
            'inc_category' => 'nullable',
            'claim_percentage' => 'nullable',
            'job_number' => 'nullable',
            'export_lc_number' => 'nullable',
            'replace_lc_number' => 'nullable',
            'lc_date' => 'nullable|date',
            'lc_value' => 'nullable',
            'invoice_value' => 'nullable',
            'realized_amount' => 'nullable',
            'claim_amount' => 'nullable',
            'claim_amount_bdt' => 'nullable',
            'last_proceed_receive_date' => 'nullable|date',
            'last_claim_submission_date' => 'nullable|date',
            'bank_apply_date' => 'nullable|date',
            'claim_submission_date' => 'nullable|date',
            'bank_reference' => 'nullable',
            'auditor_reference' => 'nullable',
            'discrepancy' => 'nullable',
            'certificate_amount' => 'nullable',
            'certificate_received_date' => 'nullable|date',
            'bangladesh_bank_reference' => 'nullable',
            'date' => 'nullable|date',
            'cash_received_amount_bdt' => 'nullable',
            'cash_received_date' => 'nullable|date',
            'page_number' => 'nullable',
            'remarks' => 'nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if (
            $request->input('company_id') === null &&
            $request->input('inc_category') === null &&
            $request->input('claim_percentage') === null &&
            $request->input('job_number') === null &&
            $request->input('export_lc_number') === null &&
            $request->input('replace_lc_number') === null &&
            $request->input('lc_date') === null &&
            $request->input('lc_value') === null &&
            $request->input('invoice_value') === null &&
            $request->input('realized_amount') === null &&
            $request->input('claim_amount') === null &&
            $request->input('claim_amount_bdt') === null &&
            $request->input('last_proceed_receive_date') === null &&
            $request->input('last_claim_submission_date') === null &&
            $request->input('bank_apply_date') === null &&
            $request->input('claim_submission_date') === null &&
            $request->input('bank_reference') === null &&
            $request->input('auditor_reference') === null &&
            $request->input('discrepancy') === null &&
            $request->input('certificate_amount') === null &&
            $request->input('certificate_received_date') === null &&
            $request->input('bangladesh_bank_reference') === null &&
            $request->input('date') === null &&
            $request->input('cash_received_amount_bdt') === null &&
            $request->input('cash_received_date') === null &&
            $request->input('page_number') === null &&
            $request->input('remarks') === null
        ) {
            return redirect()->route('cashes.index')->withErrors('All fields are null, Please fill up at least one field');
        }


        $cash = new Cash;
        $cash->company_id = $request->company_id;
        $cash->inc_category = $request->inc_category;
        $cash->claim_percentage = $request->claim_percentage;
        $cash->job_number = $request->job_number;
        $cash->export_lc_number = $request->export_lc_number;
        $cash->replace_lc_number = $request->replace_lc_number;
        $cash->lc_date = $request->lc_date;
        $cash->lc_value = $request->lc_value;
        $cash->invoice_value = $request->invoice_value;
        $cash->realized_amount = $request->realized_amount;
        $cash->claim_amount = $request->claim_amount;
        $cash->claim_amount_bdt = $request->claim_amount_bdt;
        $cash->last_proceed_receive_date = $request->last_proceed_receive_date;
        $cash->last_claim_submission_date = $request->last_claim_submission_date;
        $cash->bank_apply_date = $request->bank_apply_date;
        $cash->claim_submission_date = $request->claim_submission_date;
        $cash->bank_reference = $request->bank_reference;
        $cash->auditor_reference = $request->auditor_reference;
        $cash->discrepancy = $request->discrepancy;
        $cash->certificate_amount = $request->certificate_amount;
        $cash->certificate_received_date = $request->certificate_received_date;
        $cash->bangladesh_bank_reference = $request->bangladesh_bank_reference;
        $cash->date = $request->date;
        $cash->cash_received_amount_bdt = $request->cash_received_amount_bdt;
        $cash->cash_received_date = $request->cash_received_date;
        $cash->page_number = $request->page_number;
        $cash->remarks = $request->remarks;
        $cash->date_added = now();
        $cash->added_by = Auth::user()->id;

        // Save the cash record
        $cash->save();

        // Generate the serial number
        $serialNumber = 'CA' . date('ymd');

        if ($cash == null) {
            $lastCash = Cash::latest()->first();
            $serialNumber .= ($lastCash ? ($lastCash->id + 1) : '1');
        } else {
            $serialNumber .= $cash->id;
        }

        $cash->serial_number = $serialNumber;
        $cash->save();

        // Redirect
        // return redirect()->route('cashes.index')->withMessage('Successfully added cash record for ' . $cash->company_id.'with serial number '.$cash->serial_number);

        return redirect()->route('cashes.index')->withMessages('Successfully added cash record for ' . $cash->company_id . ' with serial number ' . $cash->serial_number);
    }


    public function show($id)
    {
        $cashes = Cash::findOrFail($id);
        return view('backend.library.cashes.show', compact('cashes'));
    }


    public function edit($id)
    {
        $cash = Cash::findOrFail($id);
        return view('backend.library.cashes.edit', compact('cash'));
    }


    public function update(Request $request, $id)
    {

        // Data update
        $cashes = Cash::findOrFail($id);

        // Get all the request data except for the _token field
        $data = $request->except('_token', '_method');

        // Iterate through each field and check if it exists in the request
        foreach ($data as $field => $value) {
            // Check if the request has a value for the field
            if ($request->has($field)) {
                // Add the field and its value to the update array
                $cashes->$field = $value;
            }
        }

        $cashes->date_modified = now();
        $cashes->modified_by = Auth::user()->id;

        $cashes->save();

        // Redirect
        return redirect()->route('cashes.index')->withMessages('Cash and related data are updated successfully!');
    }


    public function destroy($id)
    {
        $cashes = Cash::findOrFail($id);

        $cashes->delete();


        return redirect()->route('cashes.index')->withMessage('Cash and related data are deleted successfully!');
    }
}
