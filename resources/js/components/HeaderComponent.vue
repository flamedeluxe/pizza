<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link :to="`/`" class="navbar-brand">Pizza</router-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li :class="`nav-item ${currencyInner === '$' ? 'active' : ''}`">
                        <a href="" @click.prevent="changeCurrency(`$`)" class="nav-link">$</a>
                    </li>
                    <li :class="`nav-item ${currencyInner === '€' ? 'active' : ''}`">
                        <a href="" @click.prevent="changeCurrency(`€`)" class="nav-link">€</a>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="`login`">Login</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link :to="`/cart`" class="nav-link">
                            <i class="fas fa-shopping-basket"></i>
                            <sup>{{ total }}</sup>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        name: "HeaderComponent",
        props: {
            total: 0,
            currency: String
        },
        data: () => ({
            cart: {},
            currencyInner: '',
            animate: false
        }),
        mounted() {
            this.currencyInner = this.currency
        },
        methods: {
            changeCurrency(currency) {
                this.currencyInner = currency
                this.$emit('updateCurrency', this.currencyInner)

                if(localStorage.getItem('__cart') === null) return

                const cart = JSON.parse(localStorage.getItem('__cart'))

                cart.forEach(element => element.price / localStorage.getItem('__rate'));

            }
        }
    }
</script>

<style scoped>

</style>
