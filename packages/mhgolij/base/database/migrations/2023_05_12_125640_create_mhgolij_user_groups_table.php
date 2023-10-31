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
        Schema::create('mhgolij_user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('code',6);
            $table->string('name');
            $table->tinyInteger('is_admin');
            $table->integer('limitation_count')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mhgolij_user_groups');
    }
};
