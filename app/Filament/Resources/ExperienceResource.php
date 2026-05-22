<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExperienceResource\Pages;
use App\Models\Experience;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ExperienceResource extends Resource
{
    protected static ?string $model = Experience::class;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationLabel = 'Expériences';
    protected static ?string $modelLabel = 'Expérience';
    protected static ?string $pluralModelLabel = 'Expériences';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Poste')
                ->required(),
            Forms\Components\TextInput::make('company')
                ->label('Entreprise')
                ->required(),
            Forms\Components\TextInput::make('location')
                ->label('Lieu'),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->columnSpanFull(),
            Forms\Components\DatePicker::make('start_date')
                ->label('Date de début')
                ->required(),
            Forms\Components\DatePicker::make('end_date')
                ->label('Date de fin'),
            Forms\Components\Toggle::make('current')
                ->label('Poste actuel'),
            Forms\Components\Select::make('type')
                ->label('Type')
                ->options([
                    'work' => 'Expérience pro',
                    'education' => 'Formation',
                ])
                ->default('work')
                ->required(),
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
                ->label('Poste')
                ->searchable(),
            Tables\Columns\TextColumn::make('company')
                ->label('Entreprise')
                ->searchable(),
            Tables\Columns\BadgeColumn::make('type')
                ->label('Type')
                ->colors([
                    'primary' => 'work',
                    'success' => 'education',
                ]),
            Tables\Columns\IconColumn::make('current')
                ->label('Actuel')
                ->boolean(),
            Tables\Columns\TextColumn::make('start_date')
                ->label('Début')
                ->date('m/Y')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier l\'expérience'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListExperiences::route('/'),
        ];
    }
}