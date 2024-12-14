import { defineStore } from 'pinia'
export const Reservation = defineStore('ReservationStore',{
    state: ()=>(
        {
            reservations: [],
            userReservations: [],
            url: import.meta.env.VITE_API_URL,
        }
    ),
    actions:{
        async getReservations(){
            try {
                const response = await fetch(`${this.url}/getReservations`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                });
                const data = await response.json()
                if (data.sucess == true) {
                    this.reservations = data.reservations
                    return true
                }
            } catch (error) {
                return false
            }
        },

        async makeReservation(dateStart, dateEnd, user_id, property_id,token){
            try {
                console.log(dateStart, dateEnd, user_id, property_id, token)
                const response = await fetch(`${this.url}/makeReservation`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Authorization: `Bearer ${token}`,
                    },
                    body: JSON.stringify({
                        'start_date':dateStart, 
                        'end_date':dateEnd, 
                        'user_id':user_id, 
                        'property_id':property_id})
                });
                const data = await response.json()
                return data
            } catch (error) {
                return error
            }
        },
        async getUserReservations(user_id, token){
            try {
                const response = await fetch(`${this.url}/getUserReservations`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Authorization: `Bearer ${token}`,
                    },
                    body: JSON.stringify({
                        'user_id':user_id
                    })
                });
                const data = await response.json()
                this.userReservations = data
                console.log(data)
                return true
            } catch (error) {
                return false
            }
        },
    },
})