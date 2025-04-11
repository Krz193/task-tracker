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
        Schema::table('users', function (Blueprint $table) {
            $table->string('discord_id')->nullable()->unique()->after('id');
            $table->string('discord_avatar')->nullable()->after('email');
            $table->string('discord_username')->nullable()->after('name'); // Username Discord (optional)
            $table->string('discord_token')->nullable()->after('password'); // OAuth token
            $table->string('discord_refresh_token')->nullable()->after('discord_token'); // Refresh token
            $table->timestamp('discord_token_expires_at')->nullable()->after('discord_refresh_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'discord_id',
                'discord_avatar',
                'discord_username',
                'discord_token',
                'discord_refresh_token',
                'discord_token_expires_at',
            ]);
        });
    }    
};
