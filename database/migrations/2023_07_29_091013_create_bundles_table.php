<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();

            $table->string("name")->unique();
            $table->double('price')->unsigned()->default(0);
            $table->string('description')->nullable();
            $table->string('image')->default('assets/images/no_img.png');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bundles');
    }
};