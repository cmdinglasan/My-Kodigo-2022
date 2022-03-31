<?php

namespace App\Filament\Resources\CandidatesResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class CandidatesOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Presidents', '10')
                ->descriptionIcon('heroicon-s-trending-up'),
            Card::make('Vice Presidents', '9')
                ->descriptionIcon('heroicon-s-trending-up'),
        ];
    }
}
