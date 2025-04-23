@extends('layout.app')

@section('title', 'Moderation')

@section('content')
    <div class="bg-back min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">

            @include('pages.moderation.partials.header')

            @include('pages.moderation.partials.summary.summary-boxes')

            @include('pages.moderation.denunciation')

            @php
                $sections = [
                    [
                        'title' => 'Verificação de Anunciantes',
                        'filters' => ['Por Aprovar', 'Aprovados', 'Rejeitados'],
                        'headers' => ['#', 'Nome do Anunciante', 'Contacto', 'Data de Pedido', 'Documentos', 'Status', 'Ações'],
                        'rows' => [
                            ['#5644', 'João Silva', '+351 912 345 678', '15/03/2025 - 14:55', 'Sim', '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Aprovar</span>', '<a href="' . route('verification-advertiser.show', ['id' => 5644]) . '" class="btn-secondary px-3 py-1">Ver Detalhes</a>'],
                            ['#6112', 'Maria Santos', '+351 963 123 456', '16/03/2025 - 12:33', 'Sim', 'Por Aprovar', '<button class="btn-secondary px-3 py-1">Ver Detalhes</button>'],
                            ['#6141', 'Ricardo Lopes', '+351 917 654 321', '17/03/2025 - 19:43', 'Sim', 'Por Aprovar', '<button class="btn-secondary px-3 py-1">Ver Detalhes</button>'],
                            ['#6535', 'Sofia Almeida', '+351 918 222 333', '18/03/2025 - 15:46', 'Sim', 'Por Aprovar', '<button class="btn-secondary px-3 py-1">Ver Detalhes</button>'],
                        ]
                    ],
                    [
                        'title' => 'Utilizadores Suspensos',
                        'filters' => [],
                        'headers' => ['ID', 'Nome do Utilizador', 'Motivo da Suspensão', 'Data da Suspensão', 'Duração', 'Ações'],
                        'rows' => [
                            ['#5644', 'Cristiano Ronaldo', 'Má Conduta', '12/03/2025 - 14:55', '1 mês', '<div class="flex gap-2"><button class="btn-success px-3 py-1" onclick="openModal(\'reativarModal\')">Reativar</button><button class="btn-warning px-3 py-1" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                            ['#6112', 'Maria da Silva', 'Spam', '11/03/2025 - 12:33', '2 meses', '<div class="flex gap-2"><button class="btn-success px-3 py-1" onclick="openModal(\'reativarModal\')">Reativar</button><button class="btn-warning px-3 py-1" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                            ['#6141', 'Aurélio da Silva', 'Fraude', '09/03/2025 - 19:43', '1 ano', '<div class="flex gap-2"><button class="btn-success px-3 py-1" onclick="openModal(\'reativarModal\')">Reativar</button><button class="btn-warning px-3 py-1" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                            ['#6535', 'Luís Assis', 'Fraude', '07/03/2025 - 15:46', '2 anos', '<div class="flex gap-2"><button class="btn-success px-3 py-1" onclick="openModal(\'reativarModal\')">Reativar</button><button class="btn-warning px-3 py-1" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                        ]
                    ]
                ];
            @endphp

            @foreach ($sections as $section)
                @include('pages.moderation.partials.table-sections.data-section', ['section' => $section])
            @endforeach
            @include('pages.moderation.partials.modals.reactive-modal')
            @include('pages.moderation.partials.modals.prolong-modal')
        </div>
    </div>
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
@endsection
