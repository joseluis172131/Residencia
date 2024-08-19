<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('herramientas_tabla', function (Blueprint $table) {
            $table->string('imagen')->nullable()->after('sub_area');
        });
    }

    public function down()
    {
        Schema::table('herramientas_tabla', function (Blueprint $table) {
            $table->dropColumn('imagen');
        });
    }
};
