<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dollar_rates', function (Blueprint $table) {
            $table->id();
            $table->double('lbp')->unsigned()->nullable();
            $table->boolean('usage')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dollar_rates');
    }
};