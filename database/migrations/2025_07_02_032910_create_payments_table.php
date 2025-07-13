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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('fee_category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->unsignedTinyInteger('month')->nullable();
            $table->decimal('amount', 10, 2);
            $table->date('paid_at');
            $table->text('notes')->nullable();
            $table->foreignId('academic_year_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });                    
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
