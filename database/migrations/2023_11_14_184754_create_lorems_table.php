<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('lorems');
        Schema::create('lorems', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');

            $table->string('title_full');
            $table->string('description_full');
            $table->fullText(['title_full', 'description_full']);
            $table->fullText(['title_full']);
            $table->fullText(['description_full']);


            $table->string('title_index');
            $table->string('description_index');

            $table->string('title_full_index')->index();
            $table->string('description_full_index')->index();
            $table->fullText(['title_full_index']);
            $table->fullText(['description_full_index']);
            $table->fullText(['title_full_index', 'description_full_index'],'full_text_index');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lorems');
    }
};
