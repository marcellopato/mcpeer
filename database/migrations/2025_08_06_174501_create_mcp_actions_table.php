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
        Schema::create('mcp_actions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mcp_server_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('type', ['query', 'mutation', 'stream']);
            $table->string('method')->default('POST');
            $table->string('endpoint');
            $table->json('parameters')->nullable();
            $table->json('headers')->nullable();
            $table->json('body_template')->nullable();
            $table->json('response_mapping')->nullable();
            $table->text('validation_rules')->nullable();
            $table->boolean('requires_auth')->default(false);
            $table->enum('auth_type', ['none', 'bearer', 'basic', 'oauth2'])->default('none');
            $table->json('auth_config')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('timeout')->default(30);
            $table->timestamps();

            $table->unique(['mcp_server_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcp_actions');
    }
};
