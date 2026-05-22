<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationLabel = 'Projets';
    protected static ?string $modelLabel = 'Projet';
    protected static ?string $pluralModelLabel = 'Projets';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('description')
                ->label('Description')
                ->required()
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('content')
                ->label('Contenu')
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->label('Image')
                ->image()
                ->columnSpanFull(),
            Forms\Components\TextInput::make('demo_url')
                ->label('URL Démo')
                ->url(),
            Forms\Components\TextInput::make('github_url')
                ->label('URL GitHub')
                ->url(),
            Forms\Components\TagsInput::make('technologies')
                ->label('Technologies')
                ->columnSpanFull(),
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
            Tables\Columns\ImageColumn::make('image')
                ->label('Image'),
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable(),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Statut')
                ->colors([
                    'warning' => 'draft',
                    'success' => 'published',
                ]),
            Tables\Columns\IconColumn::make('featured')
                ->label('Vedette')
                ->boolean(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Créé le')
                ->dateTime('d/m/Y')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier le projet'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
        ];
    }
}