<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationLabel = 'Catégories';
    protected static ?string $modelLabel = 'Catégorie';
    protected static ?string $pluralModelLabel = 'Catégories';
    protected static ?string $navigationGroup = 'Configuration';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nom')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->columnSpanFull(),
            Forms\Components\ColorPicker::make('color')
                ->label('Couleur'),
            Forms\Components\Select::make('type')
                ->label('Type')
                ->options([
                    'project' => 'Projet',
                    'post' => 'Article',
                    'both' => 'Les deux',
                ])
                ->default('both')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nom')
                ->searchable(),
            Tables\Columns\ColorColumn::make('color')
                ->label('Couleur'),
            Tables\Columns\BadgeColumn::make('type')
                ->label('Type')
                ->colors([
                    'primary' => 'project',
                    'success' => 'post',
                    'warning' => 'both',
                ]),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime('d/m/Y')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier la catégorie'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
        ];
    }
}