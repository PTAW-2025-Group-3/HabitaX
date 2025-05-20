<div x-data="locationSelector()" x-init="init()" @click.outside="ui.reset()" class="relative w-full">
    <template x-if="viewState !== 'parishesCheckbox'">
        @include('components.location-selector.input')
    </template>

    <template x-if="open && initialized">
        <div x-show="open"
             x-transition
             class="absolute z-50 bg-white border w-full mt-1 rounded shadow max-h-80 overflow-y-auto">
            <template x-if="mode === 'start'">
                @include('components.location-selector.start')
            </template>

            <template x-if="mode === 'search'">
                @include('components.location-selector.search-results')
            </template>

            <template x-if="mode === 'list'">
                <div class="border-t">
                    <template x-if="viewState !== 'parishesCheckbox'">
                        <div class="px-4 py-2 font-medium text-blue-600 hover:bg-gray-100 cursor-pointer" @click="ui.goBack()">
                            &larr; Voltar
                        </div>
                    </template>

                    <template x-if="['districts', 'municipalities', 'parishesList'].includes(viewState)">
                        @include('components.location-selector.list-generic')
                    </template>

                    <template x-if="viewState === 'parishesCheckbox'">
                        @include('components.location-selector.checkbox-parishes')
                    </template>
                </div>
            </template>
        </div>
    </template>
</div>

@push('scripts')
    <script>
        function locationSelector() {
            return {
                initialized: false,
                open: false,
                search: '',
                mode: 'start',
                viewState: 'districts',
                suppressNextFocus: false,

                selectedIds: { district: null, municipality: null, parish: null },
                selectedParishIds: new Set(),
                expandedMunicipalities: new Set(),

                selectedDistrict: null,
                selectedMunicipality: null,
                districts: [],
                recentLocations: [],
                items: [],
                searchResults: [],

                localSearch: '',
                inputFocused: false,

                ui: {},

                init() {
                    this.ui = this.createUi(this);
                    this.dataFetch.fetchDistricts.call(this);
                    this.watchSearch();
                },

                createUi(root) {
                    return {
                        reset() {
                            root.open = false;
                            root.mode = null;
                            root.viewState = 'districts';
                        },

                        async focusInput() {
                            if (root.suppressNextFocus) return root.suppressNextFocus = false;
                            root.initialized = false;
                            root.open = true;

                            if (root.selectedIds.district) {
                                await root.ensureSelectionState();

                                root.viewState = root.selectedMunicipality
                                    ? (root.selectedParishIds.size || root.selectedIds.parish === null)
                                        ? 'parishesCheckbox'
                                        : 'parishesList'
                                    : 'municipalities';
                                root.mode = 'list';
                            } else {
                                root.mode = 'start';
                            }
                            root.initialized = true;
                        },

                        goBack() {
                            const transitions = {
                                parishesCheckbox: 'municipalities',
                                parishesList: 'municipalities',
                                municipalities: 'districts'
                            };

                            const previous = transitions[root.viewState];
                            if (previous) {
                                root.viewState = previous;
                                root.mode = 'list';
                            } else {
                                root.mode = 'start';
                            }
                        }
                    };
                },

                itemSubtitle(item) {
                    if (this.viewState === 'districts') return 'distrito';
                    if (this.viewState === 'municipalities') return `concelho`;
                    if (this.viewState === 'parishesList') return 'freguesia';
                    return '';
                },

                handleSelect(item) {
                    if (this.viewState === 'districts') return this.selectDistrict(item);
                    if (this.viewState === 'municipalities') return this.selectMunicipality(item);
                    if (this.viewState === 'parishesList') return this.selectParish(item);
                },

                async ensureSelectionState() {
                    const district = this.districts.find(d => d.id === this.selectedIds.district);
                    if (district && !district.municipalities)
                        await this.dataFetch.fetchMunicipalitiesForDistrict(district);
                    this.selectedDistrict = district;

                    const municipality = district?.municipalities?.find(m => m.id === this.selectedIds.municipality);
                    if (municipality && !municipality.parishes)
                        await this.dataFetch.fetchParishesForMunicipality(municipality);
                    this.selectedMunicipality = municipality;
                },

                select(district = null, municipality = null, parish = null, close = true) {
                    this.selectedIds = { district, municipality, parish };
                    if (close) {
                        this.open = false;
                        this.initialized = false;
                    }
                },

                async selectDistrict(d) {
                    this.selectedDistrict = d;
                    if (!d.municipalities)
                        await this.dataFetch.fetchMunicipalitiesForDistrict.call(this, d);
                    this.viewState = 'municipalities';
                },

                async selectMunicipality(m) {
                    this.selectedMunicipality = m;
                    if (!m.parishes)
                        await this.dataFetch.fetchParishesForMunicipality.call(this, m);

                    this.viewState = this.selectedParishIds.size ? 'parishesCheckbox' : 'parishesList';
                },

                selectParish(p) {
                    this.selectedParishIds = new Set([p.id]);
                    this.select(this.selectedDistrict.id, this.selectedMunicipality.id, p.id, false);
                    this.viewState = 'parishesCheckbox';
                    this.mode = 'list';
                },

                toggleParish(p) {
                    this.selectedParishIds.has(p.id)
                        ? this.selectedParishIds.delete(p.id)
                        : this.selectedParishIds.add(p.id);

                    if (this.selectedParishIds.size === this.selectedMunicipality.parishes.length) {
                        this.selectedParishIds.clear();
                        this.select(this.selectedDistrict.id, this.selectedMunicipality.id, null, false);
                    } else {
                        this.search = this.getSelectedParishSummary();
                    }

                    this.viewState = 'parishesCheckbox';
                },

                selectParishAndSwitch(p) {
                    this.selectedParishIds = new Set([p.id]);
                    this.select(this.selectedDistrict.id, this.selectedMunicipality.id, p.id, false);
                    this.viewState = 'parishesCheckbox';
                },

                selectMunicipalityWide() {
                    this.selectedParishIds = new Set();
                    this.select(this.selectedDistrict.id, this.selectedMunicipality.id, null, false);
                    this.viewState = 'parishesCheckbox';
                    this.mode = 'list';
                },

                getSelectedParishSummary() {
                    return `${this.selectedDistrict.name}, ${this.selectedMunicipality.name}, ` +
                        [...this.selectedParishIds]
                            .map(id => this.selectedMunicipality.parishes.find(p => p.id === id)?.name)
                            .filter(Boolean)
                            .join(', ');
                },

                toggleMunicipality(id) {
                    this.expandedMunicipalities.has(id)
                        ? this.expandedMunicipalities.delete(id)
                        : this.expandedMunicipalities.add(id);
                },

                limitedParishes(result) {
                    return this.expandedMunicipalities.has(result.municipality.id)
                        ? result.parishes
                        : result.parishes.slice(0, 3);
                },

                dataFetch: {
                    async fetchDistricts() {
                        this.districts = await (await fetch('/districts')).json();
                        if (this.viewState === 'districts') {
                            this.items = this.districts;
                        }
                    },
                    async fetchMunicipalitiesForDistrict(d) {
                        d.municipalities = await (await fetch(`/districts/${d.id}/municipalities`)).json();
                    },
                    async fetchParishesForMunicipality(m) {
                        m.parishes = await (await fetch(`/municipalities/${m.id}/parishes`)).json();
                    },
                    async searchParishes(q) {
                        return await (await fetch(`/parishes/search?q=${encodeURIComponent(q)}`)).json();
                    }
                },

                watchSearch() {
                    this.$watch('search', async (val) => {
                        if (this.viewState === 'parishesCheckbox') return; // отключено при чекбоксах

                        if (this.suppressSearchWatcher) {
                            this.suppressSearchWatcher = false;
                            return;
                        }

                        if (val.length < 2) {
                            this.searchResults = [];
                            return;
                        }

                        this.searchResults = await this.dataFetch.searchParishes.call(this, val);
                        this.mode = 'search';
                    });

                    this.$watch('viewState', () => {
                        if (this.viewState === 'districts') {
                            this.items = this.districts;
                        } else if (this.viewState === 'municipalities') {
                            this.items = this.selectedDistrict?.municipalities || [];
                        } else if (this.viewState === 'parishesList') {
                            this.items = this.selectedMunicipality?.parishes || [];
                        }
                    });

                    this.$watch(() => [
                        this.selectedIds.district,
                        this.selectedIds.municipality,
                        this.selectedIds.parish,
                        [...this.selectedParishIds]
                    ], () => {
                        this.search = this.generateSearchLabel();
                    }, { deep: true });
                },

                clearSelection() {
                    this.localSearch = '';
                    this.selectedIds = { district: null, municipality: null, parish: null };
                    this.selectedDistrict = null;
                    this.selectedMunicipality = null;
                    this.selectedParishIds.clear();
                },

                generateSearchLabel() {
                    if (!this.selectedDistrict) return '';
                    const parts = [this.selectedDistrict.name];
                    if (this.selectedMunicipality) {
                        parts.push(this.selectedMunicipality.name);
                        if (this.selectedParishIds.size === 0 && this.selectedIds.parish === null) {
                            parts.push('conselho inteiro');
                        } else {
                            parts.push(...[...this.selectedParishIds].map(id =>
                                this.selectedMunicipality.parishes?.find(p => p.id === id)?.name
                            ).filter(Boolean));
                        }
                    }
                    return parts.join(', ');
                }
            }
        }
    </script>
@endpush
