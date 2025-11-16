<?php

namespace App\Filament\Admin\Resources\Bookings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                TextInput::make('customer_name')
                    ->label('Customer name')
                    ->required()
                    ->minLength(3)
                    ->maxLength(250),
                TextInput::make('phone')
                    ->label('Phone number')
                    ->required()
                    ->maxLength(30)
                    ->regex('/^\\+?[0-9]+$/'),
                DateTimePicker::make('booking_date')
                    ->label('Booking date')
                    ->required()
                    ->seconds(false),
                Select::make('service_type_id')
                    ->label('Service type')
                    ->relationship('serviceType', 'name')
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->required()
                    ->hiddenOn('create'),
                Textarea::make('notes')
                    ->columnSpanFull()
                    ->rows(4),
            ]);
    }
}
