import { defineStore } from 'pinia'
export const Load = defineStore('LoadStore',{
    state: ()=>(
        {
            isLoading: false,
            isAnimating: false,
        }
    ),
    actions:{

    },
})