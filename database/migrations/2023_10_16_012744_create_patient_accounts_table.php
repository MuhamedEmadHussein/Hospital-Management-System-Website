<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('patient_id')->references('id')->on('patients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('single_invoice_id')->nullable()->references('id')->on('single__invoices')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('receipt_id')->nullable()->references('id')->on('receipt_accounts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('payment_id')->nullable()->references('id')->on('payment_accounts')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('Debit',8,2)->nullable();
            $table->decimal('credit',8,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_accounts');
    }
};
