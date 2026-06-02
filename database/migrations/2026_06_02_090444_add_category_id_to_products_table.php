<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // add column only if not exists (safe for dev)
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->foreignId('category_id')
                      ->after('price')
                      ->constrained('categories')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {

            // safely remove foreign key + column
            if (Schema::hasColumn('products', 'category_id')) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            }
        });
    }
};