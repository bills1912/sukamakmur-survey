<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Questionnaire;
use Filament\Widgets\Concerns\InteractsWithPageFilters;

class StatsOverview extends BaseWidget
{
    use InteractsWithPageFilters;
    protected static ?int $sort = 1;
    protected static ?string $pollingInterval = null;
    protected function getStats(): array
    {

        $dusun = $this->filters['dusun'] ?? null;
        return [
            Stat::make('Jumlah Petugas', $dusun == null ? Questionnaire::distinct()->count('nama_petugas') : Questionnaire::where('dusun', $dusun)->distinct()->count('nama_petugas'))
                ->description('Jumlah petugas yang telah mengisi kuesioner')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('Jumlah KK yang Telah Didata', $dusun == null ? Questionnaire::distinct()->count() : Questionnaire::where('dusun', $dusun)->distinct()->count())
                ->description('Banyaknya KK yang telah didata')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),
            Stat::make('Jumlah Suku', '5')
                ->description('Banyaknya suku yang ada di Desa Suka Makmur')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
