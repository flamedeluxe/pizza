<template>
    <div>
        <v-header
            :total="total"
            :currency="currency"
            @updateCurrency="updateCurrency">

        </v-header>
        <main>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <router-view
                            @updateCart="updateCart"
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
    export default {
        name: "AppComponent",
        data: () => ({
            total: 0,
            currency: localStorage.getItem('__currency'),
            rate: localStorage.getItem('__rate'),
        }),
        mounted() {
            this.getCurrency()
            this.updateCart()
        },
        methods: {
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
            updateCurrency(currency) {
                const rate = currency === '$' ? 1 : 1.19
                localStorage.setItem('__currency', currency)
                localStorage.setItem('__rate', rate)
                this.currency = currency
                this.rate = rate
            }
        }
    }
</script>

<style scoped>

</style>
