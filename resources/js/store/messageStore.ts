import { defineStore } from 'pinia';

export const useMessageStore = defineStore({
    id: 'mainStore',
    state: () => ({
        message: null
    }),
    actions: {
        setMessage(newMessage) {
            this.message = newMessage;
        }
    }
});
