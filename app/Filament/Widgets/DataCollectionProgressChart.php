<?php

namespace App\Filament\Widgets;

use App\Models\Questionnaire;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class DataCollectionProgressChart extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Progress Pendataan';

    protected function getData(): array
    {

        $dusun = $this->filters['dusun'] ?? null;
        return [
            'datasets' => [
                [
                    'label' => ['Progress Pendataan'],
                    'data' => Auth::user()->name != 'admin' || 'Muhammad Ervin Sugiar' || 'Deby' ?
                        ($dusun != null ? [Questionnaire::where('dusun', $dusun)->where('nama_petugas', Auth::user()->name)->count()]
                            : [Questionnaire::where('nama_petugas', Auth::user()->name)->count()])
                        : ($dusun != null ? Questionnaire::where('dusun', $dusun)->selectRaw('count(r_102) as total, nama_petugas')->groupBy('nama_petugas')->pluck('total')->toArray()
                            : Questionnaire::selectRaw('count(r_102) as total, nama_petugas')->groupBy('nama_petugas')->pluck('total')->toArray()),
                    'backgroundColor' => [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    'borderColor' => [
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    ''
                ],
            ],

            // 'labels' => Auth::user()->roles == 'surveyor' ? Questionnaire::distinct()->pluck('nama_petugas')->toArray() : Questionnaire::where('nama_petugas', Auth::user()->name)->pluck('nama_petugas')
            'labels' => Auth::user()->name != 'admin' ? Questionnaire::where('nama_petugas', Auth::user()->name)->distinct()->pluck('nama_petugas') : Questionnaire::distinct()->pluck('nama_petugas')->toArray()
        ];
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

}
