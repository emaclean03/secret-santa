<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wish_list_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wish_list_id')->constrained()->onDelete('cascade');
            $table->string('Description')->nullable();
            $table->string('item_url')->nullable();
            $table->enum('priority', ['High','Medium','Low']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wish_list_items');
    }
};
