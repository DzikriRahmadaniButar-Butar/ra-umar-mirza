<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryAndMonthToPaymentsTable extends Migration
{
    public function up()
    {
        // Schema::table('payments', function (Blueprint $table) {
        //     $table->string('category')->default('spp'); // pendaftaran, buku_pelajaran, spp
        //     $table->integer('month')->nullable(); // untuk SPP (1-12)
        // });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['category', 'month']);
        });
    }
}

