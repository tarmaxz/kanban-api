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
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->integer('position')->default(0);
            $table->timestamp('created_at')->useCurrent()->comment('The created_at timestamp registered');
            $table->timestamp('updated_at')->useCurrentOnUpdate()->comment('The updated_at timestamp registered')->nullable()->default(null);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boards');
    }
};
