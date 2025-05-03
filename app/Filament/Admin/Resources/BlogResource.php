<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\Blog;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Enums\CP\Blog\KategoriEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\BlogResource\Pages;
use App\Filament\Admin\Resources\BlogResource\RelationManagers;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationLabel = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        Forms\Components\Select::make('divisi_id')
                            ->label('Divisi')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->relationship('divisi', 'nama')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nama')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255),
                            ]),
                        Forms\Components\TextInput::make('judul')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\SpatieMediaLibraryFileUpload::make('thumbnail')
                            ->label('Thumbnail (Max. 1 file, 1 MB)')
                            ->required()
                            ->image()
                            ->collection('blog-thumbnail')
                            ->optimize('webp')
                            ->maxFiles(1),
                        Forms\Components\Select::make('kategori')
                            ->required()
                            ->options(KategoriEnum::class),
                        Forms\Components\RichEditor::make('konten')
                            ->required()
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('is_unggulan')
                            ->label('Apakah merupakan artikel unggulan?')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('divisi.nama')
                    ->label('Divisi')
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->searchable(),
                Tables\Columns\SpatieMediaLibraryImageColumn::make('thumbnail')
                    ->collection('blog-thumbnail'),
                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->getStateUsing(fn(Blog $blog) => $blog->kategori->getLabel()),
                Tables\Columns\ToggleColumn::make('is_unggulan')
                    ->label('Artikel Unggulan'),
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBlogs::route('/'),
        ];
    }
}
