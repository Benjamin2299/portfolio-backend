<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?string $navigationLabel = 'Témoignages';
    protected static ?string $modelLabel = 'Témoignage';
    protected static ?string $pluralModelLabel = 'Témoignages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nom')
                ->required(),
            Forms\Components\TextInput::make('position')
                ->label('Poste'),
            Forms\Components\TextInput::make('company')
                ->label('Entreprise'),
            Forms\Components\FileUpload::make('avatar')
                ->label('Photo')
                ->image(),
            Forms\Components\Textarea::make('content')
                ->label('Témoignage')
                ->required()
                ->columnSpanFull(),
            Forms\Components\TextInput::make('rating')
                ->label('Note (1-5)')
                ->numeric()
                ->minValue(1)
                ->maxValue(5)
                ->default(5),
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
            Tables\Columns\ImageColumn::make('avatar')
                ->label('Photo')
                ->circular(),
            Tables\Columns\TextColumn::make('name')
                ->label('Nom')
                ->searchable(),
            Tables\Columns\TextColumn::make('company')
                ->label('Entreprise'),
            Tables\Columns\TextColumn::make('rating')
                ->label('Note')
                ->suffix('/5'),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Statut')
                ->colors([
                    'warning' => 'draft',
                    'success' => 'published',
                ]),
            Tables\Columns\IconColumn::make('featured')
                ->label('Vedette')
                ->boolean(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier le témoignage'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
        ];
    }
}