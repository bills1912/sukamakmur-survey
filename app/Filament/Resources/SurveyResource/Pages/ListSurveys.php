<?php

namespace App\Filament\Resources\SurveyResource\Pages;

use App\Filament\Resources\SurveyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSurveys extends ListRecords
{
    protected static string $resource = SurveyResource::class;

    protected static ?string $title = 'Daftar Survei';

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label("Buat Survei Baru"),
        ];
    }
}
