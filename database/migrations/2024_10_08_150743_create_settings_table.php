<?php

use App\Models\Setting;
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
        Schema::create('Settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('label');
            $table->longText('value')->nullable();
            $table->string('type');
            $table->timestamps();
        });

        Setting::create([
            'key' => '_site_name',
            'label' => 'Judul',
            'value' => 'Profil Lulusan',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => '_nama_website',
            'label' => 'Nama Web',
            'value' => 'Sistem Informasi Penjaminan Mutu Pembelajaran',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => '_subjudul1',
            'label' => 'Sub Judul',
            'value' => 'Sejarah Prodi',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => '_subjudul2',
            'label' => 'Sub Judul2',
            'value' => 'Profil Lulusan',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => '_narasi1',
            'label' => 'Narasi1',
            'value' => 'lorem ipsum',
            'type' => 'longtext',
        ]);

        Setting::create([
            'key' => '_narasi2',
            'label' => 'Narasi2',
            'value' => 'lorem ipsum dolor',
            'type' => 'longtext',
        ]);

        Setting::create([
            'key' => '_hp',
            'label' => 'No Hp',
            'value' => '085414413',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => '_email',
            'label' => 'Email',
            'value' => 'teknik@gmail.com',
            'type' => 'text',
        ]);

        Setting::create([
            'key' => '_alamat',
            'label' => 'alamat',
            'value' => 'Muara dua',
            'type' => 'longtext',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Settings');
    }
};
