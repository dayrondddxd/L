<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReservaResource\Pages;
use App\Filament\Resources\ReservaResource\RelationManagers;
use App\Models\Reserva;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ReservaResource extends Resource
{
    
    protected static ?string $model = Reserva::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        $fechaMañana = date("Y-m-d", strtotime("+1 day"));
        return $form
            ->schema([
                //
                Forms\Components\Select::make('habitacion')
                ->options([
                    'Clásica'=>'Clásica',
                    'Vista mar'=>'Clásica Vista Mar',
                    'Premium'=>'Premium Vista Mar',
                    'Level'=>'The Level',
                    'Suite'=>'Grand Suite Vista Mar The Level'
                ])->required(),
                Forms\Components\DatePicker::make('fecha_entrada')
                ->required()
                ->minDate(date("Y-m-d")),

                Forms\Components\DatePicker::make('fecha_salida')
                ->required()
                ->minDate($fechaMañana),
               
                Forms\Components\Select::make('cliente_id') 
                ->relationship('cliente', 'name')
                ->searchable()
                ->preload()
                ->required() 
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->maxLength(255),
                    Forms\Components\TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->required(),
                ])
                ->required(),

                Forms\Components\TextInput::make('cant_personas')
                ->required()
                ->numeric()
                ->maxValue(4)
                ->minValue(1)
                ->label('Cantidad de Personas')
               
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('habitacion')
                ->searchable(),
                Tables\Columns\TextColumn::make('fecha_entrada')
                ->sortable(),
                Tables\Columns\TextColumn::make('fecha_salida')
                ->sortable(),
                Tables\Columns\TextColumn::make('cliente.name')
                ->searchable(),
                Tables\Columns\TextColumn::make('cant_personas'),
            ])
            ->filters([
                //
                Tables\Filters\SelectFilter::make('habitacion')
                ->options([
                    'Clásica'=>'Clásica',
                    'Vista mar'=>'Clásica Vista Mar',
                    'Premium'=>'Premium Vista Mar',
                    'Level'=>'The Level',
                    'Suite'=>'Grand Suite Vista Mar The Level'
                ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\ServadicionalesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReservas::route('/'),
            'create' => Pages\CreateReserva::route('/create'),
            'edit' => Pages\EditReserva::route('/{record}/edit'),
        ];
    }
}
