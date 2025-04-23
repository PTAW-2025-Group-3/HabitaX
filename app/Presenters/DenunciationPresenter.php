<?php

namespace App\Presenters;

use App\Models\Denunciation;
use Illuminate\Support\Str;

class DenunciationPresenter
{
    protected Denunciation $denunciation;

    public function __construct(Denunciation $denunciation)
    {
        $this->denunciation = $denunciation;
    }

    public function id(): int
    {
        return $this->denunciation->id;
    }

    public function title(): string
    {
        return Str::limit($this->denunciation->advertisement->title ?? 'N/A', 30);
    }

    public function reason(): string
    {
        return $this->denunciation->reason->name ?? 'N/A';
    }

    public function creator(): string
    {
        return $this->denunciation->creator->name ?? 'N/A';
    }

    public function submittedAt(): string
    {
        return $this->denunciation->submitted_at
            ? $this->denunciation->submitted_at->format('d/m/Y H:i')
            : 'N/A';
    }

    public function stateBadge(): string
    {
        return match ($this->denunciation->report_state) {
            0 => '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Resolver</span>',
            1 => '<span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">Aprovado</span>',
            2 => '<span class="px-2 py-1 rounded-full bg-red-100 text-red-800 text-xs font-medium">Rejeitado</span>',
            default => '<span class="px-2 py-1 rounded-full bg-gray-100 text-gray-800 text-xs font-medium">Desconhecido</span>',
        };
    }

    public function actionButton(): string
    {
        return '<a href="' . route('reported-advertisement.show', $this->id()) . '" class="btn-secondary px-3 py-1 text-xs">Ver Detalhes</a>';
    }
}
