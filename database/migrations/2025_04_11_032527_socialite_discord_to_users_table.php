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
            $table->string('avatar')->nullable()->after('email');
            $table->string('username')->nullable()->after('name'); // Username Discord (optional)
            $table->string('token')->nullable()->after('password'); // OAuth token
            $table->string('refresh_token')->nullable()->after('token'); // Refresh token
            $table->timestamp('token_expires_at')->nullable()->after('refresh_token');
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
                'avatar',
                'username',
                'token',
                'refresh_token',
                'token_expires_at',
            ]);
        });
    }    
};
