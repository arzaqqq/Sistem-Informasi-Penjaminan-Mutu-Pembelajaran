<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->after(
                function (User $record) {
                    // Cek apakah file_dokumen ada
                    if ($record->avatar_url) {
                        // Dapatkan path lengkap ke file
                        $fullPath = public_path('storage/' . $record->avatar_url); // Sesuaikan dengan path yang digunakan

                        // Hapus file fisik jika ada
                        if (file_exists($fullPath) && !is_dir($fullPath)) {
                            unlink($fullPath); // Menghapus file dari folder public
                        }
                    }
                }
            ),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
