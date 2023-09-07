<?php

namespace App\Filament\Widgets\Dashboard;
use App\Models\Member;
use App\Models\EmergencyContact;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class MemberCount extends BaseWidget
{
    protected function getStats(): array
    {
        $maleCount = Member::where('gender', 'male')->count();
        $femaleCount = Member::where('gender', 'female')->count();
        return [
            Card::make('Total Population',Member::count()),
            Card::make('Emergency',EmergencyContact::count()),
            Card::make('Boys',20),
            // Card::make('Girls',20),
            // Card::make('officers',20),



        ];
    }
}
