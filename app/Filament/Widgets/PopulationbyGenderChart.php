<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class PopulationbyGenderChart extends ChartWidget
{
    protected static ?int $sort = 3;
    
    protected static ?string $heading = 'Jumlah Penduduk Berdasarkan Jenis Kelamin';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => [450, 340,],
                ],
            ],
            'labels' => ['Laki-Laki', 'Perempuan',],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
