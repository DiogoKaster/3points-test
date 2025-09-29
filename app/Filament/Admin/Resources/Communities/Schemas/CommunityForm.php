<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\Communities\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

final class CommunityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('')->schema([
                    SpatieMediaLibraryFileUpload::make('avatar')
                        ->disk('communities')
                        ->collection('avatars')
                        ->avatar(),
                    SpatieMediaLibraryFileUpload::make('cover')
                        ->collection('covers')
                        ->image()
                        ->imageEditor()
                        ->imageEditorAspectRatios([
                            '16:9',
                        ])
                        ->disk('communities'),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->afterStateUpdated(function ($state, callable $set): void {
                            $set('slug', Str::slug($state));
                        }),
                    Textarea::make('description'),
                ])->columnSpanFull(),
            ]);
    }
}
