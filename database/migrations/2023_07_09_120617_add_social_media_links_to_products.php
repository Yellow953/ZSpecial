<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('instagram_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('shopify_link')->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

        });
    }
};