<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('fees', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('fee_category_id')->constrained()->onDelete('cascade');
        $table->foreignId('academic_year_id')->constrained()->onDelete('cascade');

        $table->string('name'); // Nama tagihan (misal "SPP Juli", "Pendaftaran")
        $table->decimal('amount', 12, 2); // total tagihan
        $table->string('month')->nullable(); // Untuk SPP bulanan, misal "Juli"
        $table->boolean('is_paid')->default(false); // dihitung otomatis
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
