<template>
    <div class="storefront">
        <StorefrontHeader/>
        <router-view/>
        <StorefrontFooter/>

        <button
            v-show="showBackToTop"
            type="button"
            aria-label="Back to top"
            class="fixed bottom-8 right-8 z-30 flex h-12 w-12 items-center justify-center rounded-full bg-green-700 text-white shadow-lg transition-all duration-300 hover:bg-green-800"
            @click="scrollToTop"
        >
            <i class="fas fa-arrow-up"></i>
        </button>
    </div>
</template>

<script>
import StorefrontHeader from "@/views/components/storefront/Header";
import StorefrontFooter from "@/views/components/storefront/Footer";

export default {
    name: "StorefrontLayout",
    components: {
        StorefrontHeader,
        StorefrontFooter,
    },
    data() {
        return {
            showBackToTop: false,
        };
    },
    mounted() {
        window.addEventListener("scroll", this.updateBackToTopVisibility, {passive: true});
        this.updateBackToTopVisibility();
    },
    beforeUnmount() {
        window.removeEventListener("scroll", this.updateBackToTopVisibility);
    },
    methods: {
        updateBackToTopVisibility() {
            this.showBackToTop = window.scrollY > 300;
        },
        scrollToTop() {
            window.scrollTo({top: 0, behavior: "smooth"});
        },
    },
};
</script>
