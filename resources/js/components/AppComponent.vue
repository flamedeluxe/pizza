<template>
    <div>
        <v-header
            v-if="!loading"
            :total="total"
            :currency="currency"
            :user="user"
            @updateCurrency="updateCurrency">
        </v-header>
        <main>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <router-view
                            @updateCart="updateCart"
                            @cleanCart="cleanCart"
                            @setUser="setUser"
                            @logout="logout"
                            :currency="currency"
                            :rate="rate"
                        >
                        </router-view>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<script>
    import {destroy, remove} from "cart-localstorage";

    export default {
        name: "AppComponent",
        data: () => ({
            total: 0,
            currency: localStorage.getItem('__currency'),
            rate: localStorage.getItem('__rate'),
            user: null,
            loading: true
        }),
        created() {
            this.setUser()
        },
        mounted() {
            this.loading = false
            this.getCurrency()
            this.updateCart()
        },
        methods: {
            async setUser() {
                if(!localStorage.getItem('token')) return
                try {
                    axios.defaults.headers.common["Authorization"] = "Bearer " + localStorage.getItem('token')
                    const {data} = await axios.post('/api/user')
                    this.user = data
                }catch (error) {
                    if (error.response.status === 401) {
                        localStorage.removeItem('user')
                        localStorage.removeItem('token')
                    }
                    else {
                        console.log('server error')
                    }
                }
            },
            getCurrency() {
                this.currency = localStorage.getItem('__currency') !== null
                    ? localStorage.getItem('__currency')
                    : '$'

                this.rate = localStorage.getItem('__rate') !== null
                    ? localStorage.getItem('__rate')
                    : 1

                localStorage.setItem('__currency', this.currency)
                localStorage.setItem('__rate', this.rate)
            },
            updateCart() {
                if(localStorage.getItem('__cart') === null) return
                let total = 0
                const cart = JSON.parse(localStorage.getItem('__cart'))

                cart.forEach(element => total += element.quantity);
                this.total = total
            },
            cleanCart() {
                const cart = JSON.parse(localStorage.getItem('__cart'))

                cart.forEach(element => remove(element.id));
                this.total = 0

                this.complete = true
            },
            updateCurrency(currency) {
                const rate = currency === '$' ? 1 : 1.19
                localStorage.setItem('__currency', currency)
                localStorage.setItem('__rate', rate)
                this.currency = currency
                this.rate = rate
            },
            logout() {
                this.user = null
            }
        }
    }
</script>

<style scoped>

</style>
