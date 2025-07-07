<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // admin input
            $table->string('name'); // misalnya "SPP", "Pendaftaran", dll
            $table->decimal('amount', 10, 2);
            $table->date('paid_at'); // pengganti due_date
            $table->text('notes')->nullable(); // catatan opsional
            $table->timestamps();
        });            }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
