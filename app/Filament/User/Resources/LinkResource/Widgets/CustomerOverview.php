<?php

namespace App\Filament\User\Resources\LinkResource\Widgets;

use App\Filament\User\Resources\LinkResource\Pages\ListLinks;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget\Stat;
class CustomerOverview extends Widget
{
    protected static string $view = 'filament.user.resources.link-resource.widgets.customer-overview';
    use InteractsWithPageTable;
    protected function getTablePage(): string
    {
        return ListLinks::class;
    }
    protected function getStats(): array
    {
        return [
            Stat::make('Всего переходов', $this->record->clicks()->count()),
        ];
    }
}
