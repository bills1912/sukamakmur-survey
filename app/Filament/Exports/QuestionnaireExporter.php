<?php

namespace App\Filament\Exports;

use App\Models\Questionnaire;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class QuestionnaireExporter extends Exporter
{
    protected static ?string $model = Questionnaire::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('survey.id'),
            ExportColumn::make('nama_petugas'),
            ExportColumn::make('kelompok_dasa_wisma'),
            ExportColumn::make('lokasi_rumah'),
            ExportColumn::make('dusun'),
            ExportColumn::make('r_102'),
            ExportColumn::make('r_103'),
            ExportColumn::make('r_104'),
            ExportColumn::make('r_200'),
            ExportColumn::make('r_201'),
            ExportColumn::make('r_202'),
            ExportColumn::make('r_203'),
            ExportColumn::make('r_204'),
            ExportColumn::make('r_205'),
            ExportColumn::make('r_206'),
            ExportColumn::make('r_207'),
            ExportColumn::make('r_207_usia'),
            ExportColumn::make('r_208'),
            ExportColumn::make('r_209'),
            ExportColumn::make('r_210'),
            ExportColumn::make('r_211'),
            ExportColumn::make('r_212'),
            ExportColumn::make('r_302_a'),
            ExportColumn::make('r_302_b'),
            ExportColumn::make('r_302_c'),
            ExportColumn::make('r_302_d'),
            ExportColumn::make('r_302_e'),
            ExportColumn::make('r_302_f'),
            ExportColumn::make('r_302_g'),
            ExportColumn::make('r_303_a'),
            ExportColumn::make('r_303_b'),
            ExportColumn::make('r_303_c'),
            ExportColumn::make('r_303_d'),
            ExportColumn::make('r_303_e'),
            ExportColumn::make('r_304_a'),
            ExportColumn::make('r_304_b'),
            ExportColumn::make('r_304_c'),
            ExportColumn::make('r_304_d'),
            ExportColumn::make('r_305_a'),
            ExportColumn::make('r_305_b'),
            ExportColumn::make('r_305_c'),
            ExportColumn::make('r_305_d'),
            ExportColumn::make('r_305_e'),
            ExportColumn::make('r_305_f'),
            ExportColumn::make('r_401'),
            ExportColumn::make('r_301'),
            ExportColumn::make('r_301_tambah'),
            ExportColumn::make('r_302_a_tambah'),
            ExportColumn::make('r_302_b_tambah'),
            ExportColumn::make('r_302_c_tambah'),
            ExportColumn::make('r_302_d_tambah'),
            ExportColumn::make('r_302_e_tambah'),
            ExportColumn::make('r_302_f_tambah'),
            ExportColumn::make('r_302_g_tambah'),
            ExportColumn::make('r_303_a_tambah'),
            ExportColumn::make('r_303_b_tambah'),
            ExportColumn::make('r_303_c_tambah'),
            ExportColumn::make('r_303_d_tambah'),
            ExportColumn::make('r_303_e_tambah'),
            ExportColumn::make('r_304_a_tambah'),
            ExportColumn::make('r_304_b_tambah'),
            ExportColumn::make('r_304_c_tambah'),
            ExportColumn::make('r_304_d_tambah'),
            ExportColumn::make('r_305_a_tambah'),
            ExportColumn::make('r_305_b_tambah'),
            ExportColumn::make('r_305_c_tambah'),
            ExportColumn::make('r_305_d_tambah'),
            ExportColumn::make('r_305_e_tambah'),
            ExportColumn::make('r_305_f_tambah'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('waktu_pendataan'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your questionnaire export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
