<?php

namespace App\Filament\Admin\Resources\ServiceTypes;

use App\Filament\Admin\Resources\ServiceTypes\Pages\CreateServiceType;
use App\Filament\Admin\Resources\ServiceTypes\Pages\EditServiceType;
use App\Filament\Admin\Resources\ServiceTypes\Pages\ListServiceTypes;
use App\Filament\Admin\Resources\ServiceTypes\Schemas\ServiceTypeForm;
use App\Filament\Admin\Resources\ServiceTypes\Tables\ServiceTypesTable;
use App\Models\ServiceType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ServiceTypeResource extends Resource
{
    protected static ?string $model = ServiceType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ServiceTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ServiceTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListServiceTypes::route('/'),
            'create' => CreateServiceType::route('/create'),
            'edit' => EditServiceType::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can('manage service types') ?? false;
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can('manage service types') ?? false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can('manage service types') ?? false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can('manage service types') ?? false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can('manage service types') ?? false;
    }
}
