<?php

namespace App\Filament\Widgets;

use App\Models\Questionnaire;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PercentagePopulationByGender extends ChartWidget
{
    protected static ?string $heading = 'Persentase Penduduk Berdasarkan Jenis Kelamin';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $jenis_kelamin = [];
        for ($i = 1; $i <= Questionnaire::all()->count(); $i++) {
            array_push($jenis_kelamin, Questionnaire::whereIn('id', Questionnaire::where('id' ,'>' ,0)->pluck('id')->toArray())->get()->pluck('r_200')->first()[0]['r_205']);
        }
        return [
            'datasets' => [
                [
                    'label' => 'Persentase Jumlah Penduduk',
                    'data' => [600, 500],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                ],
            ],
            
            'labels' => ['Laki-Laki', 'Perempuan',],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
