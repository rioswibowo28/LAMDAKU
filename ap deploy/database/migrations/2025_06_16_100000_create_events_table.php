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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content');
            $table->string('location');
            $table->string('address')->nullable();
            
            // Event timing
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->boolean('is_all_day')->default(false);
            $table->string('timezone')->default('Asia/Jakarta');
            
            // Event details
            $table->string('category')->nullable();
            $table->json('tags')->nullable();
            $table->string('event_type')->default('public'); // public, private, hybrid
            $table->string('status')->default('draft'); // draft, published, cancelled, completed
            
            // Registration
            $table->boolean('requires_registration')->default(false);
            $table->integer('max_participants')->nullable();
            $table->integer('current_participants')->default(0);
            $table->decimal('registration_fee', 10, 2)->default(0);
            $table->datetime('registration_deadline')->nullable();
            $table->text('registration_instructions')->nullable();
            
            // Contact info
            $table->string('contact_person')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('website_url')->nullable();
            
            // Media
            $table->string('featured_image')->nullable();
            $table->json('gallery')->nullable();
            
            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            
            // System fields
            $table->unsignedBigInteger('author_id');
            $table->timestamp('published_at')->nullable();
            $table->integer('view_count')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('allow_comments')->default(true);
            
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            
            // Indexes for performance
            $table->index(['status', 'published_at']);
            $table->index(['start_date', 'end_date']);
            $table->index(['author_id']);
            $table->index(['slug']);
            $table->index(['is_featured']);
            $table->index(['category']);
            $table->index(['event_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
