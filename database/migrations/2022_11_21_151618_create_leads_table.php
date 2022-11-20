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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->bigInteger("price")->nullable();
            $table->unsignedBigInteger("account_id")->nullable();
            $table->unsignedBigInteger("responsible_user_id")->nullable();
            $table->unsignedBigInteger("group_id")->nullable();
            $table->unsignedBigInteger("status_id")->nullable();
            $table->unsignedBigInteger("pipeline_id")->nullable();
            $table->unsignedBigInteger("loss_reason_id")->nullable();
            $table->unsignedBigInteger("source_id")->nullable();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->boolean("is_deleted")->nullable();
            $table->jsonb("custom_fields_values")->nullable();
            $table->integer("score")->nullable();
            $table->jsonb("company")->nullable();
            $table->timestamp("closest_task_at")->nullable();
            $table->timestamp("closed_at")->nullable();
            $table->timestamp("created_at")->nullable();;
            $table->timestamp("updated_at")->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
