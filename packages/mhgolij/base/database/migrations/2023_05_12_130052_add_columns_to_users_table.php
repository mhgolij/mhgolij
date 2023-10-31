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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('group_id')->after('name')->references('id')->on('mhgolij_user_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->string('mobile')->nullable()->after('name');
            $table->string('phone')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('name');
            $table->string('user_name')->after('name');
            $table->string('birth_date')->nullable()->after('name');
            $table->tinyInteger('is_admin')->default(0)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('group_id');
            $table->dropColumn('mobile');
            $table->dropColumn('phone');
            $table->dropColumn('last_name');
            $table->dropColumn('user_name');
            $table->dropColumn('is_admin');
        });
    }
};
