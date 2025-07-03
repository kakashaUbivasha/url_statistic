<?php

namespace App\Filament\User\Resources\LinkResource\Pages;

use App\Filament\User\Resources\LinkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateLink extends CreateRecord
{
    protected static string $resource = LinkResource::class;
    public function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['short_code'] = Str::random(6);
        return $data;
    }
}
