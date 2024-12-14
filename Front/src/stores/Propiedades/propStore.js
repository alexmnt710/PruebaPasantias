import { defineStore } from 'pinia'
export const Propiedades = defineStore('PropiedadesStore',{
    state: ()=>(
        {
            propers: [],
            filters: [],
            url: import.meta.env.VITE_API_URL,
        }
    ),
    actions:{
        async getPropiedes(){
            try {
                const response = await fetch(`${this.url}/getProperties`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
                const data = await response.json()
                this.propers = data
                console.log(data)
            } catch (error) {
                return false
            }
        },
        async applyFilters(filters){
            console.log(filters)
            try {
                const response = await fetch(`${this.url}/filterProperties`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(filters)
                });
                const data = await response.json()
                console.log(data)
                if(data.success){
                    return false
                }
                this.propers = data
            } catch (error) {
                console.log(error)
                return false
            }
        }
    },
})