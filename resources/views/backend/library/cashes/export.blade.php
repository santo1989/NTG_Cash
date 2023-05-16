
<table id="cashesTable" style="border: 1px solid #000; padding: 4px; border-collapse: collapse; padding-top: 1em;">
    <thead style="border: 1px solid #000; padding: 4px;">
        <tr>
            <th colspan="28" style="text-align: center; border: none; ">
                {{-- <img src="{{ asset('images/assets/ntg_logo.png') }}" alt="Logo" style="height: 100px
                ; width:50px;"> --}}
                <span style="font-size: 24px; float: left;">Northern Tosrifa Group</span><br>
                <span style="float: right; font-size: 10px">Download Date: {{ Carbon\Carbon::now()->format('d-M-Y') }}</span>
            </th>
        </tr>
        <tr>
            <th style="border: 1px solid #000; padding: 4px;">Serial Number</th>
            <th style="border: 1px solid #000; padding: 4px;">Company</th>
            <th style="border: 1px solid #000; padding: 4px;">Inc Category</th>
            <th style="border: 1px solid #000; padding: 4px;">Claim Percentage</th>
            <th style="border: 1px solid #000; padding: 4px;">Job Number</th>
            <th style="border: 1px solid #000; padding: 4px;">Export LC Number</th>
            <th style="border: 1px solid #000; padding: 4px;">Replace LC Number</th>
            <th style="border: 1px solid #000; padding: 4px;">LC Date</th>
            <th style="border: 1px solid #000; padding: 4px;">LC Value</th>
            <th style="border: 1px solid #000; padding: 4px;">Invoice Value</th>
            <th style="border: 1px solid #000; padding: 4px;">Realized Amount</th>
            <th style="border: 1px solid #000; padding: 4px;">Claim Amount</th>
            <th style="border: 1px solid #000; padding: 4px;">Claim Amount BDT</th>
            <th style="border: 1px solid #000; padding: 4px;">Last Proceed Receive Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Last Claim Submission Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Bank Apply Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Claim Submission Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Bank Reference</th>
            <th style="border: 1px solid #000; padding: 4px;">Auditor Reference</th>
            <th style="border: 1px solid #000; padding: 4px;">Discrepancy</th>
            <th style="border: 1px solid #000; padding: 4px;">Certificate Amount</th>
            <th style="border: 1px solid #000; padding: 4px;">Certificate Received Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Bangladesh Bank Reference</th>
            <th style="border: 1px solid #000; padding: 4px;">Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Cash Received Amount BDT</th>
            <th style="border: 1px solid #000; padding: 4px;">Cash Received Date</th>
            <th style="border: 1px solid #000; padding: 4px;">Page Number</th>
            <th style="border: 1px solid #000; padding: 4px;">Remarks</th>
        </tr>
    </thead>
    <tbody style="border: 1px solid #000; padding: 4px;">
        @foreach ($search_cashes as $cash)
            <tr>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->serial_number }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->company_id }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->inc_category }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->claim_percentage }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->job_number }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->export_lc_number }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->replace_lc_number }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ \Carbon\Carbon::parse($cash->lc_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->lc_value }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->invoice_value }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->realized_amount }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->claim_amount }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->claim_amount_bdt }}</td>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ \Carbon\Carbon::parse($cash->last_proceed_receive_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ \Carbon\Carbon::parse($cash->last_claim_submission_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ \Carbon\Carbon::parse($cash->bank_apply_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ \Carbon\Carbon::parse($cash->claim_submission_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->bank_reference }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->auditor_reference }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->discrepancy }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->certificate_amount }}</td>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ \Carbon\Carbon::parse($cash->certificate_received_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->bangladesh_bank_reference }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ \Carbon\Carbon::parse($cash->date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->cash_received_amount_bdt }}</td>
                <td style="border: 1px solid #000; padding: 4px;">
                    {{ \Carbon\Carbon::parse($cash->cash_received_date)->format('d-M-Y') }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->page_number }}</td>
                <td style="border: 1px solid #000; padding: 4px;">{{ $cash->remarks }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
