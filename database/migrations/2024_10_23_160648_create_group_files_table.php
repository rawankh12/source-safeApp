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
        Schema::create('group_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("file_id")->unsigned();
            $table->foreign("file_id")->references("id")
                ->on("files")->onDelete("cascade");
            $table->bigInteger("group_id")->unsigned();
            $table->foreign("group_id")->references("id")
                ->on("groups")->onDelete("cascade");
                $table->string('status')->default('free');
                $table->string('type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_files');
    }
};
