<?php

namespace App\Filament\Resources\ReservaResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServadicionalesRelationManager extends RelationManager
{
    protected static string $relationship = 'servadicionales';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('description')
                    ->required()
                    ->maxLength(255)
                    ->label('Descripción')
                    ->columnSpan('full'),

                Forms\Components\TextArea::make('notes')
                    ->maxLength(65535)
                    ->label('Notas')
                    ->columnSpan('full'),

                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->label('Precio')
                    ->prefix('$')
                    ->maxValue(1000000),


            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('description')
            ->columns([
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('price')
                ->money('usd')
                ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
