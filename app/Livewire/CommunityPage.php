<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Community;
use App\Models\Post;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;
use Livewire\WithPagination;

final class CommunityPage extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use WithPagination;

    public Community $community;

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    public function createPost(): Action
    {
        return Action::make('createPost')
            ->modalHeading('Criar post')
            ->color(Color::Indigo)
            ->schema([
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),
                MarkdownEditor::make('body')
                    ->label('Corpo')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->modalSubmitActionLabel('Criar')
            ->modalCancelActionLabel('Cancelar')
            ->action(function (array $data): void {
                Post::query()->create([
                    'title' => $data['title'],
                    'body' => $data['body'],
                    'author_id' => Auth::id(),
                    'community_id' => $this->community->id,
                ]);

                $this->dispatch('refresh-sidebar-communities');
            });
    }

    public function joinCommunity(): RedirectResponse|Redirector|null
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $this->community->members()->attach(Auth::user());

        $this->dispatch('refresh-sidebar-communities');

        return null;
    }

    public function leaveCommunity(): RedirectResponse|Redirector|null
    {
        if (Auth::guest()) {
            return redirect()->route('login');
        }

        $this->community->members()->detach(Auth::user());

        $this->dispatch('refresh-sidebar-communities');

        return null;
    }

    public function render(): View
    {
        $this->community->loadCount('members');

        $isMember = false;
        if (Auth::check()) {
            $isMember = $this->community->members()->where('user_id', Auth::id())->exists();
        }

        $posts = $this->community
            ->posts()
            ->with('author')
            ->latest()
            ->paginate(10);

        return view('livewire.community-page', [
            'posts' => $posts,
            'isMember' => $isMember,
        ]);
    }
}
