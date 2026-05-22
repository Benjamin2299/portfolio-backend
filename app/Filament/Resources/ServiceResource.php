<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';
    protected static ?string $navigationLabel = 'Services';
    protected static ?string $modelLabel = 'Service';
    protected static ?string $pluralModelLabel = 'Services';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required(),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required()
                ->columnSpanFull(),
            Forms\Components\TextInput::make('icon')
                ->label('Icône'),
            Forms\Components\ColorPicker::make('color')
                ->label('Couleur'),
            Forms\Components\TextInput::make('price')
                ->label('Prix')
                ->numeric()
                ->prefix('FCFA'),
            Forms\Components\Select::make('status')
                ->label('Statut')
                ->options([
                    'draft' => 'Brouillon',
                    'published' => 'Publié',
                ])
                ->default('published')
                ->required(),
            Forms\Components\Toggle::make('featured')
                ->label('En vedette'),
            Forms\Components\TextInput::make('order')
                ->label('Ordre')
                ->numeric()
                ->default(0),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable(),
            Tables\Columns\TextColumn::make('price')
                ->label('Prix')
                ->suffix(' FCFA'),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Statut')
                ->colors([
                    'warning' => 'draft',
                    'success' => 'published',
                ]),
            Tables\Columns\IconColumn::make('featured')
                ->label('Vedette')
                ->boolean(),
            Tables\Columns\TextColumn::make('order')
                ->label('Ordre')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier le service'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListServices::route('/'),
        ];
    }
}