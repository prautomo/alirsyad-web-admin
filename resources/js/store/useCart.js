import create from 'zustand'

import { persist } from "zustand/middleware"
import _ from 'underscore'


const useCart = create(persist((set, get) => ({
    cart: {},

    addItem: (reqItem) => {

        var cartState = localStorage.getItem("cart-storage") ? JSON.parse(localStorage.getItem("cart-storage")).state : {}
        console.log(cartState)

        set(state => ({ cart: { ...cartState.cart, ...reqItem } }))
    },
    removeItem: (key) => {

        var tempState = { ...get().cart }
        delete tempState[key]
        set((state) => ({ cart: tempState }))
    },
    removeAllItem: () => set({ cart: {} }),
    getTotalTransaksi: () => {
        var currentCart = { ...get().cart }
        return _.reduce(Object.keys(currentCart), (memo, iten) => {

            var item = currentCart[iten]
            var realPrice = item.selling_price - (item.discount > 0 ? item.discount : 0)
            return Number(item.jumlah * realPrice) + Number(memo)

        }, 0)
    },

    mapCartByMitra: () => {
        
        var currentCart = { ...get().cart }
        var grouped = _.groupBy(currentCart, (item) => {
            return  item.mitra_id
        })



        
        console.log(grouped)

        return  grouped
        
    }
}), {
    name: "cart-storage", // unique name
    getStorage: () => localStorage, // (optional) by default the 'localStorage' is used
}))

export default useCart;