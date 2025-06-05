<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class AverageNetIncomeChart extends ChartWidget
{
    protected static ?int $sort = 4;

    protected static ?string $heading = 'Rata-Rata Pendapatan Bersih Penduduk Desa Suka Makmur';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Rata-Rata Pendapatan Bersih',
                    'data' => [9000, 12000, 15000, 4300],
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                ],
            ],
            
            'labels' => ['Pertanian Padi/Palawija', 'Perikanan', 'Peternakan', 'Lainnya',],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
