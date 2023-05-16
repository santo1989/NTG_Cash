<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->string('serial_number')->unique()->nullable();
            $table->string('company_id')->nullable();
            $table->string('inc_category')->nullable();
            $table->string('claim_percentage')->nullable();
            $table->string('job_number')->nullable();
            $table->string('export_lc_number')->nullable();
            $table->string('replace_lc_number')->nullable();
            $table->date('lc_date')->nullable();
            $table->string('lc_value')->nullable();
            $table->string('invoice_value')->nullable();
            $table->string('realized_amount')->nullable();
            $table->string('claim_amount')->nullable();
            $table->string('claim_amount_bdt')->nullable();
            $table->date('last_proceed_receive_date')->nullable();
            $table->date('last_claim_submission_date')->nullable();
            $table->date('bank_apply_date')->nullable();
            $table->date('claim_submission_date')->nullable();
            $table->string('bank_reference')->nullable();
            $table->string('auditor_reference')->nullable();
            $table->string('discrepancy')->nullable();
            $table->string('certificate_amount')->nullable();
            $table->date('certificate_received_date')->nullable();
            $table->string('bangladesh_bank_reference')->nullable();
            $table->date('date')->nullable();
            $table->string('cash_received_amount_bdt')->nullable();
            $table->date('cash_received_date')->nullable();
            $table->string('page_number')->nullable();
            $table->string('remarks')->nullable();
            $table->dateTime('date_added')->nullable();
            $table->string('added_by')->nullable();
            $table->dateTime('date_modified')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cashes');
    }
}
