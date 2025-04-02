@extends('layout.app')

@section('title', 'Moderation')

@section('content')
    <div class="bg-gray-100 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-8 lg:px-10 space-y-8">

            @include('pages.moderation.partials.header')

            @include('pages.moderation.partials.summary.summary-boxes')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                @include('pages.moderation.partials.charts.charts-bar')
                @include('pages.moderation.partials.charts.charts-donut')
                @include('pages.moderation.partials.charts.charts-line')
            </div>

            @php
                $sections = [
                    [
                        'title' => 'Verificação de Anunciantes',
                        'filters' => ['Por Aprovar', 'Aprovados', 'Rejeitados'],
                        'headers' => ['#', 'Nome do Anunciante', 'Contacto', 'Data de Pedido', 'Documentos', 'Status', 'Ações'],
                        'rows' => [
                            ['#5644', 'João Silva', '+351 912 345 678', '15/03/2025 - 14:55', '✅ Sim', '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Aprovar</span>', '<a href="' . route('verification-advertiser.show', ['id' => 5644]) . '" class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</a>'],
                            ['#6112', 'Maria Santos', '+351 963 123 456', '16/03/2025 - 12:33', '✅ Sim', '⏳ Por Aprovar', '<button class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</button>'],
                            ['#6141', 'Ricardo Lopes', '+351 917 654 321', '17/03/2025 - 19:43', '✅ Sim', '⏳ Por Aprovar', '<button class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</button>'],
                            ['#6535', 'Sofia Almeida', '+351 918 222 333', '18/03/2025 - 15:46', '✅ Sim', '⏳ Por Aprovar', '<button class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</button>'],
                        ]
                    ],
                    [
                        'title' => 'Anúncios Reportados',
                        'filters' => ['Todos', 'Por Resolver', 'Resolvidos'],
                        'headers' => ['ID', 'Título do Anúncio', 'Anunciante', 'Data do Report', 'Motivo', 'Status', 'Ações'],
                        'rows' => [
                            ['#8644','Apartamento T2 Paris','Aurélio da Silva','12/03/2025 - 14:58', 'Fraude', '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Resolver</span>', '<div class="flex gap-1"><a href="' . route('reported-advertisement.show', ['id' => 8644]) . '" class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</a></div>'],
                            ['#9112', 'Moradia Lisboa', 'Maria da Silva', '10/03/2025 - 12:33', 'Spam', '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Resolver</span>', '<button class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</button>'],
                            ['#8141', 'Apartamento T2 Porto', 'Aurélio da Silva', '09/03/2025 - 18:43', 'Fraude', '<span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-xs font-medium">Resolvido</span>', '<div class="flex gap-1"><button class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</button>'],
                            ['#8535', 'Apartamento T2 Porto', 'Aurélio da Silva', '07/03/2025 - 16:46', 'Fraude', '<span class="px-2 py-1 rounded-full bg-yellow-100 text-yellow-800 text-xs font-medium">Por Resolver</span>', '<button class="bg-gray-900 text-white text-xs rounded-full px-3 py-1 hover:bg-gray-700 transition">Ver Detalhes</button>'],
                        ]
                    ],
                    [
                        'title' => 'Utilizadores Suspensos',
                        'filters' => [],
                        'headers' => ['ID', 'Nome do Utilizador', 'Motivo da Suspensão', 'Data da Suspensão', 'Duração', 'Ações'],
                        'rows' => [
                            ['#5644', 'Cristiano Ronaldo', 'Má Conduta', '12/03/2025 - 14:55', '1 mês', '<div class="flex gap-2"><button class="bg-emerald-600 text-white text-xs px-3 py-1 rounded-full hover:bg-emerald-700" onclick="openModal(\'reativarModal\')">Reativar</button><button class="bg-amber-600 text-white text-xs px-3 py-1 rounded-full hover:bg-amber-700" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                            ['#6112', 'Maria da Silva', 'Spam', '11/03/2025 - 12:33', '2 meses', '<div class="flex gap-2"><button class="bg-emerald-600 text-white text-xs px-3 py-1 rounded-full hover:bg-emerald-700" onclick="openModal(\'reativarModal\')">Reativar</button><button class="bg-amber-600 text-white text-xs px-3 py-1 rounded-full hover:bg-amber-700" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                            ['#6141', 'Aurélio da Silva', 'Fraude', '09/03/2025 - 19:43', '1 ano', '<div class="flex gap-2"><button class="bg-emerald-600 text-white text-xs px-3 py-1 rounded-full hover:bg-emerald-700" onclick="openModal(\'reativarModal\')">Reativar</button><button class="bg-amber-600 text-white text-xs px-3 py-1 rounded-full hover:bg-amber-700" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
                            ['#6535', 'Luís Assis', 'Fraude', '07/03/2025 - 15:46', '2 anos', '<div class="flex gap-2"><button class="bg-emerald-600 text-white text-xs px-3 py-1 rounded-full hover:bg-emerald-700" onclick="openModal(\'reativarModal\')">Reativar</button><button class="bg-amber-600 text-white text-xs px-3 py-1 rounded-full hover:bg-amber-700" onclick="openModal(\'prolongarModal\')">Prolongar</button></div>'],
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
