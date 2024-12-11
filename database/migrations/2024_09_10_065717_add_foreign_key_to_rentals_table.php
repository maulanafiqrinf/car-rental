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
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign(['car_id']); // Drop the existing foreign key constraint
        });
    }
    
    public function down()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('set null');
        });
    }
    
};
