import { defineStore } from 'pinia'
export const User = defineStore('UserStore',{
    state: ()=>(
        {
            users: [],
            url: import.meta.env.VITE_API_URL,
        }
    ),
    actions:{
        async getUsers(){
            try {
                const response = await fetch(`${this.url}/getUsers`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
                const data = await response.json()
                if (data.sucess == true) {
                    this.users = data.users
                    return true
                }
            } catch (error) {
                return false
            }
        },
    },
})