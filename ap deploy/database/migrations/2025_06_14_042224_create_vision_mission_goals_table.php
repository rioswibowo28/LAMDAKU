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
        Schema::create('vision_mission_goals', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['vision', 'mission', 'goal'])->comment('Type: vision, mission, or goal');
            $table->string('title')->comment('Title of the item');
            $table->text('content')->comment('Main content/description');
            $table->text('description')->nullable()->comment('Additional description or subtitle');
            $table->string('icon_class')->nullable()->comment('FontAwesome icon class');
            $table->string('background_color')->default('#e3f2fd')->comment('Background color for styling');
            $table->integer('sort_order')->default(1)->comment('Order for display');
            $table->boolean('is_active')->default(true)->comment('Active status');
            $table->timestamps();
            
            // Indexes
            $table->index(['type', 'is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vision_mission_goals');
    }
};
