<template>
    <main class="storefront-home" @click="handleAnchorClick">
        <HeroSection />
        <!-- Categories Carousel -->
        <CategoryCarousel :categories="categories" />
        <!-- Featured Products -->
        <FeaturedProducts />
        <!-- Three Column Product Listing Section -->
        <ProductHighlights />
        <!-- Features Section -->
        <FeaturesSection />
        <!-- Parallax Banner -->
        <ParallaxBanner />
        <!-- Popular Products -->
        <PopularProducts />
        <!-- Special Offers Section -->
        <SpecialOffers />
        <!-- Testimonials -->
        <TestimonialsSection />
        <!-- Instagram Feed -->
        <InstagramFeed />
    </main>
</template>

<script>
import HeroSection from './HeroSection.vue';
import CategoryCarousel from './CategoryCarousel.vue';
import FeaturedProducts from './FeaturedProducts.vue';
import ProductHighlights from './ProductHighlights.vue';
import FeaturesSection from './FeaturesSection.vue';
import ParallaxBanner from './ParallaxBanner.vue';
import PopularProducts from './PopularProducts.vue';
import SpecialOffers from './SpecialOffers.vue';
import TestimonialsSection from './TestimonialsSection.vue';
import InstagramFeed from './InstagramFeed.vue';

export default {
    name: 'StorefrontHome',
    components: {
        HeroSection,
        CategoryCarousel,
        FeaturedProducts,
        ProductHighlights,
        FeaturesSection,
        ParallaxBanner,
        PopularProducts,
        SpecialOffers,
        TestimonialsSection,
        InstagramFeed,
    },
    data() {
        return {
            productSlider: null,
            categorySlider: null,
            categories: [
                {slug: 'milks-dairy', name: 'Milks & Dairy', image: 'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'wines-drinks', name: 'Wines & Drinks', image: 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'fresh-produce', name: 'Fresh Produce', image: 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'pantry-staples', name: 'Pantry Staples', image: 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'milks-dairy', name: 'Milks & Dairy', image: 'https://images.unsplash.com/photo-1550583724-b2692b85b150?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'wines-drinks', name: 'Wines & Drinks', image: 'https://images.unsplash.com/photo-1514933651103-005eec06c04b?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'fresh-produce', name: 'Fresh Produce', image: 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=400&h=400&q=80'},
                {slug: 'pantry-staples', name: 'Pantry Staples', image: 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?auto=format&fit=crop&w=400&h=400&q=80'},
            ],
        };
    },
    mounted() {
        document.title = 'Revonna Organics - Pure Organic Products';
        if (window.Splide) {
            this.initializeSliders();
        } else {
            document.querySelector('[data-splide-script]')?.addEventListener('load', this.initializeSliders, {once: true});
        }
    },
    beforeUnmount() {
        this.productSlider?.destroy(true);
        this.categorySlider?.destroy(true);
    },
    methods: {
        initializeSliders() {
            if (!window.Splide) {
                return;
            }

            const categoryEl = this.$el.querySelector('.category-splide');
            if (categoryEl) {
                this.categorySlider = new window.Splide(categoryEl, {
                    type: this.categories.length > 6 ? 'loop' : 'slide',
                    perPage: 6,
                    perMove: 1,
                    gap: '1.5rem',
                    pagination: false,
                    breakpoints: {
                        1024: {perPage: 4},
                        768: {perPage: 3},
                        480: {perPage: 2},
                    },
                }).mount();
            }

            const productEl = this.$el.querySelector('.product-splide');
            if (!productEl) {
                return;
            }

            this.productSlider = new window.Splide(productEl, {
                type: 'loop',
                perPage: 4,
                perMove: 1,
                gap: '1rem',
                pagination: false,
                breakpoints: {
                    1024: {perPage: 3},
                    768: {perPage: 2},
                    640: {perPage: 1},
                },
            }).mount();
        },
        onNewsletterSubmit(event) {
            const email = event.currentTarget.querySelector('input[type="email"]')?.value;
            if (!email) {
                return;
            }

            window.alert('Thank you for subscribing with ' + email + '!');
            event.currentTarget.reset();
        },
        handleAnchorClick(event) {
            const link = event.target.closest('a[href^="#"]');
            if (!link || link.getAttribute('href') === '#') {
                return;
            }

            const target = document.querySelector(link.getAttribute('href'));
            if (target) {
                event.preventDefault();
                target.scrollIntoView({behavior: 'smooth'});
            }
        },
    },
};
</script>
