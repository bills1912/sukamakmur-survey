<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PopulationbyEducationChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected static ?string $heading = 'Jumlah Penduduk Berdasarkan Pendidikan';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => ['Jumlah Penduduk'],
                    'data' => [55, 34, 100, 200, 23, 120, ],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                ],
            ],

            'labels' => ['Tidak Sekolah/Belum Bersekolah', 'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat', "D1/D2/D3", 'S1/S2/S3', ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
