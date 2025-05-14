@extends('account.account-layout')

@section('account-content')
    @if(session('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg shadow-sm animate-fade-in">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="bi bi-check-circle text-green-500"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif
<div class="bg-white rounded-xl shadow-lg p-6 animate-fade-in">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-primary">Meus Anúncios</h1>
        <a href="{{ route('advertisements.create') }}" class="btn-primary py-2 px-4 flex items-center gap-2">
            <i class="bi bi-plus-lg"></i>
            Criar Anúncio
        </a>
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <p class="text-gray">
            Aqui estão os anúncios que publicou na HabitaX.
        </p>

        <!-- Status Filter -->
        <div class="relative dropdown-wrapper w-full sm:w-64">
            <form method="GET" action="{{ route('advertisements.my') }}">
                <select id="state_filter" name="state_filter"
                        class="dropdown-select py-2 pl-4 pr-10 w-full h-10 border border-gray-300 rounded-lg"
                        onchange="this.form.submit()">
                    <option value="all" {{ request('state_filter') === 'all' ? 'selected' : '' }}>Todos</option>
                    <option value="published" {{ request('state_filter') === 'published' ? 'selected' : '' }}>Publicados</option>
                    <option value="pending" {{ request('state_filter') === 'pending' ? 'selected' : '' }}>Não Publicados</option>
                    <option value="suspended" {{ request('state_filter') === 'suspended' ? 'selected' : '' }}>Suspendidos</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray">
                    <i class="chevron bi bi-chevron-right transition-transform duration-300 ease-in-out"></i>
                </div>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($ads as $ad)
            @include('advertisements.ad-card', ['ad' => $ad])
        @endforeach
    </div>

    <!-- No ads message (hidden by default) -->
    <div id="no-ads" class="hidden text-center py-10">
        <i class="bi bi-megaphone text-gray-400 text-5xl mb-4"></i>
        <h3 class="text-lg font-medium text-gray-800">Nenhum anúncio encontrado</h3>
        <p class="text-gray-600 mt-2">Não foram encontrados anúncios com o status selecionado.</p>
    </div>
</div>

<div class="mt-6">
    {{ $ads->links() }}
</div>

@endsection
