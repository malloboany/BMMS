<?php

namespace App\Filament\Admin\Resources\ServiceTypes\Pages;

use App\Filament\Admin\Resources\ServiceTypes\ServiceTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceType extends CreateRecord
{
    protected static string $resource = ServiceTypeResource::class;
}
