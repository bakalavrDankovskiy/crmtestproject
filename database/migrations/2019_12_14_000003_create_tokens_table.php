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
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('amocrm');
            $table->string('client_id')->nullable();
            $table->string('access_token', 2000)->unique();
            $table->string('refresh_token', 2000)->unique();
            $table->string('base_domain', 100)->default(config('services.amocrm.sub_domain'));
            $table->unsignedInteger('last_used_at')->nullable();
            $table->unsignedInteger('expires_at')->nullable();
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
        Schema::dropIfExists('tokens');
    }
};
