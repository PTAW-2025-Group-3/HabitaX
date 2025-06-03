<div x-data="locationSelector('#{{ $triggerId }}')" x-init="init()" x-show="isOpen" @click.outside="handleClickOutside($event)" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-2xl shadow-xl overflow-hidden max-h-[90vh] overflow-y-auto">
        <div class="border-b p-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Selecionar Localização</h2>
            <button @click="closeModal" class="text-gray-500 hover:text-black">&times;</button>
        </div>

        <div class="p-4 space-y-4">
            <!-- Mode Switcher -->
            <div class="flex space-x-4">
                <button :class="{ 'font-bold': mode === 'list' }" @click="mode = 'list'">Selecionar pela Lista</button>
                <button :class="{ 'font-bold': mode === 'search' }" @click="mode = 'search'">Pesquisar pelo Nome</button>
                <button class="ml-auto text-sm text-red-600 underline" @click="resetState">Reiniciar</button>
            </div>

            <!-- Search -->
            <div x-show="mode === 'search'">
                @include('components.location-picker-modal.search')
            </div>

            <!-- Select by List -->
            <div x-show="mode === 'list'">
                @include('components.location-picker-modal.list')
            </div>
        </div>

        <div class="border-t p-4 text-right" x-show="selectedMunicipality || selectedParishes.length">
            <button @click="confirmAndSaveHistory" class="px-4 py-2 bg-green-600 text-white rounded">Confirmar</button>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function locationSelector(triggerId) {
            return {
                triggerId: triggerId,
                isOpen: false,
                mode: 'list',
                districts: [],
                municipalities: [],
                parishes: [],
                selectedDistrict: null,
                selectedMunicipality: null,
                selectedParishes: [],
                searchQuery: '',
                searchResults: [],
                searchHistory: [],

                async fetchDistricts() {
                    const res = await fetch('/districts');
                    this.districts = await res.json();
                },

                async fetchMunicipalities(districtId) {
                    const res = await fetch(`/districts/${districtId}/municipalities`);
                    this.municipalities = await res.json();
                },

                async fetchParishes(municipalityId) {
                    const res = await fetch(`/municipalities/${municipalityId}/parishes`);
                    this.parishes = await res.json();
                },

                async performSearch() {
                    if (this.searchQuery.length < 2) {
                        this.searchResults = [];
                        return;
                    }

                    const res = await fetch(`/locations/search?q=${encodeURIComponent(this.searchQuery)}`);
                    const data = await res.json();
                    this.searchResults = data;
                    console.log('searchResults:', data);
                },

                openModal() {
                    this.isOpen = true;
                    this.loadHistory();
                    if (this.districts.length === 0) this.fetchDistricts();
                },

                closeModal() {
                    this.isOpen = false;
                },

                openChooseMode(districtId = null, municipalityId = null) {
                    this.contextDistrict = districtId;
                    this.contextMunicipality = municipalityId;
                    this.mode = 'chooseMode';
                },

                openList() {
                    this.mode = 'list';
                },

                openSearch() {
                    this.mode = 'search';
                },

                resetState() {
                    this.mode = 'list';
                    this.selectedDistrict = null;
                    this.selectedMunicipality = null;
                    this.selectedParishes = [];
                    this.municipalities = [];
                    this.parishes = [];
                    this.searchResults = [];
                    this.searchQuery = '';
                },

                selectDistrict(district) {
                    this.selectedDistrict = district;
                    this.selectedMunicipality = null;
                    this.selectedParishes = [];
                    this.fetchMunicipalities(district.id);
                },

                selectWholeDistrict() {
                    this.selectedMunicipality = null;
                    this.selectedParishes = [];
                    this.saveToHistory();
                    this.closeModal();
                },

                selectMunicipality(municipality) {
                    this.selectedMunicipality = municipality;
                    this.selectedParishes = [];
                    this.fetchParishes(municipality.id);
                },

                selectWholeMunicipality() {
                    this.selectedParishes = [...this.parishes.map(p => p.id)];
                    this.saveToHistory();
                    this.closeModal();
                },

                toggleParish(id) {
                    if (this.selectedParishes.includes(id)) {
                        this.selectedParishes = this.selectedParishes.filter(p => p !== id);
                    } else {
                        this.selectedParishes.push(id);
                    }
                },

                selectSearchLocation(result) {
                    this.selectedDistrict = { name: result.district };
                    this.selectedMunicipality = { name: result.municipality };
                    this.selectedParishes = [result.id];
                    this.parishes = [{
                        id: result.id,
                        name: result.name,
                        municipality_id: result.municipality_id,
                        district_id: result.district_id,
                    }];

                    this.saveToHistory();
                    this.closeModal();
                }
                ,

                goBack() {
                    if (this.selectedMunicipality) {
                        this.selectedMunicipality = null;
                        this.parishes = [];
                    } else if (this.selectedDistrict) {
                        this.selectedDistrict = null;
                        this.municipalities = [];
                    }
                },

                confirmAndSaveHistory() {
                    this.saveToHistory();
                    this.closeModal();
                },

                saveToHistory() {
                    const selectedParishObjs = this.parishes.filter(p => this.selectedParishes.includes(p.id));

                    const uniqueMunicipalities = new Set(selectedParishObjs.map(p => p.municipality_id));
                    const uniqueDistricts = new Set(selectedParishObjs.map(p => p.district_id));

                    const district = uniqueDistricts.size === 1 ? this.selectedDistrict : null;
                    const municipality = uniqueMunicipalities.size === 1 ? this.selectedMunicipality : null;

                    const newItem = {
                        district,
                        municipality,
                        parishes: this.selectedParishes,
                        parishNames: selectedParishObjs.map(p => p.name),
                        timestamp: Date.now(),
                    };

                    let history = [];
                    const match = document.cookie.match(/(?:^|; )locationHistory=([^;]*)/);
                    if (match) {
                        try {
                            history = JSON.parse(decodeURIComponent(match[1]));
                        } catch (e) {
                            history = [];
                        }
                    }

                    history = history.filter(item =>
                        JSON.stringify(item.district) !== JSON.stringify(newItem.district) ||
                        JSON.stringify(item.municipality) !== JSON.stringify(newItem.municipality) ||
                        JSON.stringify(item.parishes) !== JSON.stringify(newItem.parishes)
                    );

                    history.unshift(newItem);

                    history = history.slice(0, 5);

                    document.cookie = `locationHistory=${encodeURIComponent(JSON.stringify(history))}; path=/; max-age=31536000`; // 1 год
                    this.searchHistory = history;
                },

                loadHistory() {
                    const match = document.cookie.match(/(?:^|; )locationHistory=([^;]*)/);
                    if (match) {
                        try {
                            this.searchHistory = JSON.parse(decodeURIComponent(match[1]));
                        } catch (e) {
                            this.searchHistory = [];
                        }
                    } else {
                        this.searchHistory = [];
                    }
                },

                deleteHistoryItem(index) {
                    this.searchHistory.splice(index, 1);
                    document.cookie = `locationHistory=${encodeURIComponent(JSON.stringify(this.searchHistory))}; path=/; max-age=2592000`;
                },

                selectFromHistory(item) {
                    this.selectedDistrict = item.district;
                    this.selectedMunicipality = item.municipality;
                    this.selectedParishes = item.parishes;
                    this.closeModal();
                },

                handleClickOutside(event) {
                    const modal = event.target.closest('.bg-white');
                    if (!modal) this.closeModal();
                },

                init() {
                    const trigger = document.querySelector(this.triggerId);
                    if (trigger) {
                        trigger.addEventListener('click', () => this.openModal());
                    }
                },
            }
        }
    </script>
@endpush
