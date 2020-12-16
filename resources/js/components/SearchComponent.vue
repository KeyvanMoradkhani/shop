<template>
    <div class="row products-category">
        <div class="row">
            نتیجه جستجو: <a> {{this.search}}</a>
        </div>
        <div class="product-layout product-grid col-lg-3 col-md-3 col-sm-4 col-xs-12"
             v-for="product in products.data">
            <div class="product-thumb">
                <div class="image">
                    <a :href="'http://shop.test/product/' + product.slug">
                        <img style="width: 50%"
                            :src="'http://shop.test/' + product.photos[0].path " alt="تی شرت کتان مردانه"
                            class="img-responsive"/>
                    </a>
                </div>
                <div class="caption">
                    <h4><a href="product.html">{{product.title}}</a></h4>
<!--                    <p v-html="product.description">-->
<!--                    </p>-->
                    <p class="price" v-if="product.discount_price">
                        <span class="price-new">{{product.discount_price}} تومان</span>
                        <span class="price-old">{{product.price}} تومان</span>
                        <span class="saving">{{Math.round(Math.abs((product.price-product.discount_price)/product.price *100))}}%</span>
                    </p>
                    <p class="price" v-if="!product.discount_price">
                        <span class="price-new">{{product.price}} تومان</span>
                    </p>
                </div>
                <div class="button-group">
                    <a class="btn-primary" type="button"
                       :href="'http://shop.test/add-to-cart/' + product.id"><span>افزودن به سبد</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row" v-if="products.last_page">
            <div class="col-sm-12" style="text-align: center">
                <paginate
                    v-model="page"
                    :page-count="products.last_page"
                    :page-range="3"
                    :margin-pages="2"
                    :click-handler="clickCallback"
                    :prev-text="'قبلی'"
                    :next-text="'بعدی'"
                    :container-class="'pagination'"
                    :page-class="'page-item'">
                </paginate>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                products: [],
                page: 1,
                pagination: 2,
            }
        },
        props: ['search'],
        mounted() {
            console.log(this.search);
            axios.get('/api/search/' + this.search).then(
                res => {
                    this.products = res.data.products;
                    console.log(res.data.products);
                }
            ).catch(err => {
                console.log(err)
            })
        },
        methods: {
            clickCallback: function (pageNum) {
                this.products = [];
                axios.get('/api/search/' + this.search + '?page=' + pageNum).then(
                    res => {
                        this.products = res.data.products;
                        console.log(res.data.products);
                    }
                ).catch(err => {
                    console.log(err)
                })
            },
        }
    }
</script>
