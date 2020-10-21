<template>
    <div>
        <h1 class="mb-5">Cart</h1>

        <cart
            :cart="cart"
            :rate="rate"
            :currency="currency"
            @removeItem="removeItem"
        >
        </cart>


    </div>
</template>

<script>
    import cart from '../components/CartComponent';

    export default {
        name: "Cart",
        data: () => ({
            cart: {},
        }),
        props: {
            currency: String,
            rate: String|Number
        },
        components: {
            cart
        },
        mounted() {
            this.getCart()
        },
        methods: {
            getCart() {
                const items = JSON.parse(localStorage.getItem('__cart'))
                this.cart = items
            },
            removeItem() {
                this.getCart()
            }
        }
    }
</script>

<style scoped>

</style>
