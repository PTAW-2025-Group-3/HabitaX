<div>
    {{--        <div class="text-sm text-gray-500 p-2">SELECIONADAS RECENTEMENTE</div>--}}
    {{--        <template x-for="(recent, index) in recentLocations" :key="recent.key">--}}
    {{--            <div class="flex items-center justify-between px-4 py-2 hover:bg-gray-100">--}}
    {{--                <div @click="history.load(recent)" class="cursor-pointer w-full">--}}
    {{--                    <span x-text="recent.label"></span>--}}
    {{--                </div>--}}
    {{--                <button @click.stop="history.remove(index)" class="text-gray-400 hover:text-red-500 ml-2">&times;</button>--}}
    {{--            </div>--}}
    {{--        </template>--}}

    <div class="border-t">
        <div @click="mode = 'map'; open = false" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Pesquisar no mapa</div>
        <div @click="mode = 'address'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Pesquisar por morada</div>
        <div @click="mode = 'list'" class="px-4 py-2 hover:bg-gray-100 cursor-pointer">Escolher localização a partir da lista</div>
    </div>
</div>
