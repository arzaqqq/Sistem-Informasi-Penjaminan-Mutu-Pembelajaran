<?php

namespace App\Filament\Resources\HasilResource\Pages;

use Filament\Tables;
use App\Models\Hasil;
use App\Models\Kelas;
use App\Models\Matakuliah;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Resources\Pages\Page;
use App\Filament\Resources\HasilResource;
use Filament\Tables\Filters\SelectFilter;

class NilaiMahasiswa extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static string $resource = HasilResource::class;

    protected static string $view = 'filament.resources.hasils.nilai-mahasiswa';

    public $matakuliah;
    public $kelas;
    public $matakuliahData;
    public $kelasData;

    public function mount($matakuliah, $kelas)
    {
        $this->matakuliah = $matakuliah;
        $this->kelas = $kelas;

        // Mengambil data matakuliah dan kelas untuk header halaman
        $this->matakuliahData = Matakuliah::find($matakuliah);
        $this->kelasData = Kelas::find($kelas);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Hasil::query()
                    ->where('matakuliah_id', $this->matakuliah)
                    ->where('kelas_id', $this->kelas)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_mahasiswa')
                    ->label('Nama Mahasiswa')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('nim')
                    ->label('NIM')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('quiz')
                    ->label('Nilai Quiz')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tugas')
                    ->label('Nilai Tugas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('uts')
                    ->label('Nilai UTS')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('uas')
                    ->label('Nilai UAS')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('total_nilai')
                    ->label('Total Nilai')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('huruf_mutu')
                    ->label('Huruf Mutu')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Optional filters khusus untuk halaman ini
                SelectFilter::make('huruf_mutu')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'C' => 'C',
                        'D' => 'D',
                        'E' => 'E',
                    ])
                    ->label('Filter Huruf Mutu'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn ($record) => route('filament.admin.resources.hasils.edit', $record)),
                    // Aksi Hapus
                Tables\Actions\DeleteAction::make()
                ->label('Hapus')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading(fn (Hasil $record) => "Hapus data nilai {$record->nama_mahasiswa}")
                ->modalDescription('Apakah Anda yakin ingin menghapus data nilai mahasiswa ini? Tindakan ini tidak dapat dibatalkan.')
                ->modalSubmitActionLabel('Ya, Hapus Data')
                ->successNotificationTitle('Data nilai mahasiswa berhasil dihapus')
                ->after(function () {
                    // Refresh halaman setelah menghapus data
                    $this->js('window.location.reload()');
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('export')
                    ->label('Export Nilai')
                    ->icon('heroicon-o-document')
                    ->action(fn () => $this->export()),
            ]);
    }

    public function getTitle(): string
    {
        if ($this->matakuliahData && $this->kelasData) {
            return "Nilai Mahasiswa: {$this->matakuliahData->nama_mk} - {$this->kelasData->nama_kelas}";
        }

        return "Nilai Mahasiswa";
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('kembali')
                ->label('Kembali ke Daftar')
                ->url(route('filament.admin.resources.hasils.index'))
                ->icon('heroicon-o-arrow-left'),
        ];
    }

    // Method untuk export nilai (opsional, dapat diimplementasikan)
    public function export()
    {
        // Implementasi export nilai
    }
}
