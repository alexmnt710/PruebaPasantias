
import { defineStore } from 'pinia'
export const Auth = defineStore('AuthStore',{
    state: ()=>(
        {
            url: import.meta.env.VITE_API_URL,
            sesion : false,
            user: [],
            token: '',
        }
    ),
    actions:{
        async prueba(){ 
            try {
                const response = await fetch(`${this.url}/example`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
                console.log(response)
            } catch (error) {
                console.log(error)
            }
        },
        async checkSession(){
            
            if (localStorage.getItem('user') && localStorage.getItem('token')) {
                this.user = JSON.parse(localStorage.getItem('user'))
                this.token = localStorage.getItem('token')
                this.sesion = true
                console.log('Token enviado:', this.token);
                const response = await fetch(`${this.url}/checkSession`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',   
                        'Authorization': `Bearer ${this.token}`,
                    },
                });
                const data = await response.json()
                if (data.success == true) {
                    return true
                }else{
                    this.clearStore()
                    return false
                }
            }
            return false
        },
        async login(email, password){
                const response = await fetch(`${this.url}/login`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({email, password}),
                });
                const data = await response.json()
                if (data.success == true) {
                    console.log(data)
                    this.sesion = true
                    this.user = data.user
                    this.token = data.access_token
                    this.setLocalStorage()
                    
                }
                return data
        },
        async register(user){
            try {
                const response = await fetch(`${this.url}/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(user),
                });
                const data = await response.json()
                console.log(data)
            } catch (error) {
                console.error(error)
            }
        },
        async logout(){
            const response = await fetch(`${this.url}/logout`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Authorization: `Bearer ${this.token}`,
                },
                
            });
            const data = await response.json()
            if (data.success == true) {
                this.clearStore()
            }
            return data
        },
        setLocalStorage() {
            try {
                localStorage.setItem('user', JSON.stringify(this.user));
                localStorage.setItem('token', this.token);
            } catch (error) {
                console.error("Failed to set local storage:", error);
            }
        },
        
        removeLocalStorage() {
            try {
                localStorage.removeItem('user');
                localStorage.removeItem('token');
            } catch (error) {
                console.error("Failed to remove local storage:", error);
            }
        },
        async clearStore(){
            this.sesion = false
            this.user = []
            this.token = ''
            this.removeLocalStorage()
        },
        async register(user){
            console.log(user)
            try {
                const response = await fetch(`${this.url}/register`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(user),
                });
                const data = await response.json()
                console.log(data)
                return data
            } catch (error) {
                console.error(error)
            }
        },
        
    },
})