<template>
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold text-gray-800 mb-2 heading-font">Browse All Categories</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Explore our wide range of organic products</p>
        </div>

        <div class="splide category-splide" aria-label="Categories">
            <div class="splide__track">
                <ul class="splide__list">
                    <li v-for="category in categories" :key="category.slug" class="splide__slide">
                        <router-link :to="`/category/${category.slug}`" class="category-item">
                            <div class="category-circle">
                                <img :src="category.image" :alt="category.name">
                            </div>
                            <h3 class="category-title">{{ category.name }}</h3>
                        </router-link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'CategoryCarousel',
    props: {
        categories: {
            type: Array,
            required: true,
        },
    },
};
</script>
