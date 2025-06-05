<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('Filter Dashboard')
                    ->schema([
                        Select::make('dusun')
                            ->label('Dusun')
                            ->options([
                                '1' => 'Dusun I-A',
                                '2' => 'Dusun I-B',
                                '3' => 'Dusun II Timur',
                                '4' => 'Dusun II Barat',
                                '5' => 'Dusun III',
                                '6' => 'Dusun IV',
                            ])
                            ->placeholder('Pilih Dusun')
                            ->searchable()
                            ->native(false),
                    ])
            ]);
    }
}
