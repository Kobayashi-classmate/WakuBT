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
        Schema::create('version_settings', function (Blueprint $table) {
            $table->id();
            $table->string('software_name')->comment('软件名称');
            $table->string('version_number')->comment('版本号');
            $table->timestamp('release_date')->comment('发布时间');
            $table->text('change_log')->comment('更新日志');
            $table->boolean('is_enabled')->default(true)->comment('是否启用');
            $table->boolean('is_visible')->default(false)->comment('是否展示');
            $table->timestamps();

            // 添加索引
            $table->index('version_number');
            $table->index('software_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('version_settings');
    }
};
