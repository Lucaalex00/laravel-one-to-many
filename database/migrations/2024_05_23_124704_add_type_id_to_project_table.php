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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->after('id')->nullable();
            $table->foreign('type_id')->references('id')->on('projects')->onDelete('set null');

            // TAKE 'projects' TABLE , insert 'type_id' like an 'foreign' key
            // 'project_type_id_foreign   <---- 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign('project_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};
