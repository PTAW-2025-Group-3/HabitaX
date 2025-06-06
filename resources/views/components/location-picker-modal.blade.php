<div x-data="locationSelector('#{{ $triggerId }}')" x-init="init()" x-show="isOpen" @click.outside="handleClickOutside($event)" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-xl w-full max-w-2xl shadow-xl overflow-hidden max-h-[90vh] overflow-y-auto">
        <div class="border-b p-4 flex justify-between items-center">
            <h2 class="text-lg font-semibold">Selecionar Localização</h2>
            <button @click="closeModal" class="text-gray-500 hover:text-black">&times;</button>
        </div>

        <div class="p-4 space-y-4">
            <div x-show="mode === ''">
                @include('components.location-picker-modal.selected')
            </div>
            <div x-show="mode === 'choose'">
                @include('components.location-picker-modal.choose')
            </div>
            <div x-show="mode === 'search'">
                @include('components.location-picker-modal.search')
            </div>
            <div x-show="mode === 'list'">
                @include('components.location-picker-modal.list')
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        function locationSelector(triggerId) {
            return {
                triggerId: triggerId,
                isOpen: false,
                mode: '',
                districts: [],
                municipalities: [],
                parishes: [],
                selectedDistricts: [],
                selectedMunicipalities: [],
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
                    this.searchResults = await res.json();
                },

                openModal() {
                    this.isOpen = true;
                    this.loadHistory();
                    if (this.districts.length === 0) this.fetchDistricts();
                },

                closeModal() {
                    this.isOpen = false;
                },

                openChooseMode() {
                    this.mode = 'choose';
                },

                openList() {
                    this.mode = 'list';
                },

                openSearch() {
                    this.mode = 'search';
                },

                resetState() {
                    this.mode = 'list';
                    this.selectedDistricts = [];
                    this.selectedMunicipalities = [];
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
                },

                goBack() {
                    if (this.selectedMunicipalities.length > 0) {
                        this.selectedMunicipalities.pop();
                    } else if (this.selectedDistricts.length > 0) {
                        this.selectedDistricts.pop();
                    }
                },

                confirmAndSaveHistory() {
                    this.saveToHistory();
                    this.closeModal();
                },

                saveToHistory() {
                    const selectedParishObjs = this.parishes.filter(p => this.selectedParishes.includes(p.id));
                    const districtsIds = [...new Set(selectedParishObjs.map(p => p.district_id))];
                    const municipalitiesIds = [...new Set(selectedParishObjs.map(p => p.municipality_id))];

                    const newItem = {
                        districts: this.selectedDistricts,
                        municipalities: this.selectedMunicipalities,
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
                        JSON.stringify(item.districts) !== JSON.stringify(newItem.districts) ||
                        JSON.stringify(item.municipalities) !== JSON.stringify(newItem.municipalities) ||
                        JSON.stringify(item.parishes) !== JSON.stringify(newItem.parishes)
                    );

                    history.unshift(newItem);
                    history = history.slice(0, 5);

                    document.cookie = `locationHistory=${encodeURIComponent(JSON.stringify(history))}; path=/; max-age=31536000`;
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
                    this.selectedDistricts = item.districts;
                    this.selectedMunicipalities = item.municipalities;
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
