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
            $table->timestamp('returned_at')->nullable()->after('end_date');
            $table->decimal('total_price', 10, 2)->nullable()->after('returned_at');
        });
    }
    
    public function down()
    {
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropColumn(['returned_at', 'total_price']);
        });
    }
    
};
