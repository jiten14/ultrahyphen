<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\SpatieTagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\SpatieTagsColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Set;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Blog';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->maxLength(255)
                            ->dehydrated()
                            ->unique(Post::class, 'slug', ignoreRecord: true),
                        Toggle::make('is_featured')
                        ->label('Featured'),
                        Forms\Components\RichEditor::make('content')
                            ->required()
                            ->columnSpan('full'),
                        Forms\Components\FileUpload::make('image')
                            ->label('Image')
                            ->image()
                            ->disableLabel()
                            ->columnSpan('full'),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable(),
                        SpatieTagsInput::make('tags'),
                        Toggle::make('is_published')
                            ->label('Publish'),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ToggleColumn::make('is_published')
                            ->label('Publish'),
                ToggleColumn::make('is_featured')
                ->label('Featured'),
                Tables\Columns\ImageColumn::make('image')
                ->label('Image'),
                Tables\Columns\TextColumn::make('title')
                    ->words(4)
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('category.name')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                SpatieTagsColumn::make('tags')
                ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
            'view' => Pages\ViewPost::route('/{record}'),
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Section::make()
                    ->schema([
                    Infolists\Components\ImageEntry::make('image')
                                        ->width('100%')
                                        ->height('auto')
                                        ->columnSpan(2)
                                        ->hiddenLabel(),
                    Infolists\Components\TextEntry::make('content')->html()->columnSpan(2),
                    Infolists\Components\IconEntry::make('is_featured')
                                                ->label('featured')
                                                ->boolean(),
                    Infolists\Components\TextEntry::make('title'),
                    Infolists\Components\TextEntry::make('slug'),
                    Infolists\Components\TextEntry::make('category.name'),
                    Infolists\Components\SpatieTagsEntry::make('tags'),
                    Infolists\Components\TextEntry::make('user.name'),
                    Infolists\Components\IconEntry::make('is_published')
                                                ->label('Published')
                                                ->boolean(),
                    ])
                    ->columns(3),
            ]);
    }
}
