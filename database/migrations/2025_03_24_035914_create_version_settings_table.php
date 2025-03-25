<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\VersionSettings;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('version_settings', function (Blueprint $table) {
            $table->id();
            $table->string('software_name');
            $table->string('version_number');
            $table->timestamp('release_date');
            $table->text('change_log');
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_visible')->default(false);
            $table->timestamps();

            // 添加索引
            $table->index('version_number');
            $table->index('software_name');
        });


        /**
         * 初始化数据库内容
         */

        VersionSettings::create([
            'software_name' => '1',
            'version_number' => '9.5.0',
            'release_date' => '2025-03-24 00:00:00',
            'change_log' => '暂无更新日志',
            'is_enabled' => 1,
            'is_visible' => 1,
        ]);

        VersionSettings::create([
            'software_name' => '2',
            'version_number' => '8.2.1',
            'release_date' => '2024-12-06 00:00:00',
            'change_log' => '暂无更新日志',
            'is_enabled' => '1',
            'is_visible' => '1',
        ]);

        VersionSettings::create([
            'software_name' => '3',
            'version_number' => '7.0.13',
            'release_date' => '2024-11-17 00:00:00',
            'change_log' => '暂无更新日志',
            'is_enabled' => '1',
            'is_visible' => '1',
        ]);

        VersionSettings::create([
            'software_name' => '4',
            'version_number' => '2.3.0',
            'release_date' => '2024-04-24 00:00:00',
            'change_log' => '暂无更新日志',
            'is_enabled' => '1',
            'is_visible' => '1',
        ]);

        VersionSettings::create([
            'software_name' => '5',
            'version_number' => '5.3',
            'release_date' => '2025-02-24 15:19:17',
            'change_log' => '暂无更新日志',
            'is_enabled' => '1',
            'is_visible' => '1',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('version_settings');
    }
};
