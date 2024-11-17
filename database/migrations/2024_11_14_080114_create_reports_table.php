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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("user_id")->unsigned();
            $table->foreign("user_id")->references("id")
                ->on("users")->onDelete("cascade");

            $table->bigInteger("file_id")->unsigned();
            $table->foreign("file_id")->references("id")
                ->on("files")->onDelete("cascade");

            $table->bigInteger("group_id")->unsigned();
            $table->foreign("group_id")->references("id")
                ->on("groups")->onDelete("cascade");

            $table->string('report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
