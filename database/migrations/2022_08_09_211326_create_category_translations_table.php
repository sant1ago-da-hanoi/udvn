<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'description'
            ]);
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->char('lang', 2)->default('vi');
            $table->string('name')->unique();
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('category_translations');

        Schema::table('categories', function (Blueprint $table) {
            $table->string('name')->unique()->after('id');
            $table->text('description')->nullable()->after('path');
        });
    }
};
