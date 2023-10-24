import { defineStore } from 'pinia';

export const usePreferencesStore = defineStore({
    id: 'preferences',

    state: () => ({
        subclient_id: null as string | null,
        grid_id: null as string | null,
    }),

    getters: {
        getSubclientId(): string | null {
            return this.subclient_id;
        },
        getGridId(): string | null {
            return this.grid_id;
        }
    },

    actions: {
        setSubclientId(subclientId: string) {
            this.subclient_id = subclientId;
            localStorage.setItem('subclient_id', subclientId);
        },
        setGridId(gridId: string) {
            this.grid_id = gridId;
            localStorage.setItem('grid_id', gridId);
        },
        loadPreferencesFromLocalStorage() {
            const subclientId = localStorage.getItem('subclient_id');
            const gridId = localStorage.getItem('grid_id');

            if (subclientId) {
                this.subclient_id = subclientId;
            }
            if (gridId) {
                this.grid_id = gridId;
            }
        }
    },
});
