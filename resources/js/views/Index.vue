<template>
    <div>
        <h1 class="mb-5">Catalog</h1>

        <div class="row" v-if="loading">
            <div v-for="i in 6" class="col-md-4" style="color:#ddd">
                <div class="card mb-4 box-shadow">
                    <div class="card-img-top" style="background:#ddd;height: 225px; width: 100%; display: block;"></div>
                    <div class="card-body">
                        <p class="card-title" style="background:#ddd">MADISON</p>
                        <p class="card-text" style="background:#ddd">Prosciutto and housemade pineapple-jalapeño chutney on white.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <big style="background:#ddd">
                                15 $
                            </big>
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary" style="background:#ddd;border-color:#ddd">
                                    <span style="color:#ddd" class="material-icons">shopping_basket</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if="!loading">
            <product
                v-for="product in products"
                :key="product.id"
                :product="product"
                :currency="currency"
                @updateCart="updateCart"
            ></product>
        </div>

    </div>
</template>

<script>
    import {add, total} from "cart-localstorage";
    import product from '../components/ProductComponent';

    export default {
        name: "Index",
        data: () => ({
            products: {},
            loading: true
        }),
        props: {
            currency: String
        },
        components: {
            add, total,
            product
        },
        computed: {

        },
        async mounted() {
            this.products = await this.loadProducts()

        },
        methods: {
            async loadProducts() {
                try {
                    const {data} = await axios.get(`/api/products`)
                    this.loading = false
                    return data
                }catch (e) {
                    console.log('server error')
                }
            },
            updateCart() {
                this.$emit('updateCart')
            }
        }
    }
</script>

<style scoped>

</style>
