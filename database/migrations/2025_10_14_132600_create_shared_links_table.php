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
        Schema::create('shared_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('album_id')->nullable()->constrained('albums')->onDelete('cascade');
            $table->char('token', 64)->unique();
            $table->string('email', 255)->nullable(); // Nullable for manual sharing
            $table->timestamp('deliver_at')->nullable(); // For scheduled email delivery
            $table->timestamp('expires_at')->nullable(); // For link expiration
            $table->timestamps();

            // Optional: Ensure exactly one of project_id or album_id is set
            $table->checkConstraint('(project_id IS NOT NULL AND album_id IS NULL) OR (project_id IS NULL AND album_id IS NOT NULL)', 'check_project_or_album');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shared_links');
    }
};