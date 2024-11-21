<?php

namespace App\Filament\Widgets;

use App\Models\Reserva;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ReservaHabitacionOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Clásica', Reserva::query()->where('habitacion', 'Clásica')->count()),
            Stat::make('Clásica Vista Mar', Reserva::query()->where('habitacion', 'Vista mar')->count()),
            Stat::make('Premium Vista Mar', Reserva::query()->where('habitacion', 'Premium')->count()),
            Stat::make('The Level', Reserva::query()->where('habitacion', 'Level')->count()),
            Stat::make('Grand Suite Vista Mar The Level', Reserva::query()->where('habitacion', 'Suite')->count()),
        ];
    }
}
