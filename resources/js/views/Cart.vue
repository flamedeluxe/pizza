<template>
    <div>
        <h1 class="mb-5">Cart</h1>

        <cart-component
            :cart="cart"
            :rate="rate"
            :currency="currency"
            @removeItem="removeItem"
            @updateTotal="updateTotal"
            @updateCart="updateCart"
        >
        </cart-component>

        <order-component
            v-if="total"
            :rate="rate"
            :total="total"
            :currency="currency"
        ></order-component>
    </div>
</template>

<script>
    import CartComponent from '../components/CartComponent';
    import OrderComponent from "../components/OrderComponent";

    export default {
        name: "Cart",
        data: () => ({
            cart: {},
            total: 0
        }),
        props: {
            currency: String,
            rate: String|Number
        },
        components: {
            CartComponent,
            OrderComponent
        },
        mounted() {
            this.getCart()
        },
        methods: {
            getCart() {
                const items = JSON.parse(localStorage.getItem('__cart'))
                this.cart = items
            },
            updateTotal(total) {
                this.total = Math.round(total * this.rate)
            },
            removeItem() {
                this.getCart()
            },
            updateCart() {
                this.$emit('updateCart')
            }
        }
    }
</script>

<style scoped>

</style>
