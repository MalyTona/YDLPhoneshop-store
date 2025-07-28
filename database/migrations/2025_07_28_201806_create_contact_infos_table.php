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
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            // For the main section header
            $table->string('title_main');       // For 'ទីតាំង'
            $table->string('title_highlight');  // For 'ហាងយើង'
            $table->text('description');

            // For the contact details
            $table->string('address');
            $table->string('phone_1');
            $table->string('phone_2')->nullable();
            $table->string('opening_hours');
            $table->string('telegram_link')->nullable();

            // For Google Maps URLs
            $table->text('map_embed_url');
            $table->text('map_directions_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_infos');
    }
};
