<?php

namespace App\Filament\Resources\QuestionnaireResource\Pages;

use App\Filament\Resources\QuestionnaireResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use Illuminate\Support\Facades\Auth;

class ListQuestionnaires extends ListRecords
{
    protected static string $resource = QuestionnaireResource::class;

    protected static ?string $title = 'Daftar Hasil Pendataan';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label("Buat Pendataan Baru")
                ->icon('heroicon-s-plus'),
            ExportAction::make()
                ->visible(Auth::user()->name == 'admin')
                ->exports([
                    ExcelExport::make()
                        ->fromTable()
                        ->withFilename(fn($resource) => $resource::getModelLabel() . '-' . date('Y-m-d'))
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX)
                        ->withColumns([
                            Column::make('updated_at'),
                        ])
                ]),
        ];
    }
}
