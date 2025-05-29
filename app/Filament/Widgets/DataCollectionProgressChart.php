<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DataCollectionProgressChart extends ChartWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Progress Pendataan';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => ['Progress Pendataan'],
                    'data' => [50, 34, 100, 200],
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

            'labels' => ['Pendata 1', 'Pendata 2', 'Pendata 3', 'Pendata 4',],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
