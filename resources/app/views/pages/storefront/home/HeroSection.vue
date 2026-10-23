<template>
<section class="hero-section flex items-center relative">
    <div class="container mx-auto px-4 text-white">
        <div class="max-w-3xl">
            <span
                class="bg-green-700 bg-opacity-80 text-white px-4 py-2 rounded-full text-sm mb-4 inline-block">100%
                Organic Certified</span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 heading-font leading-tight">Pure Organic
                Products for Healthy Living</h1>
            <p class="text-lg md:text-xl mb-8">Discover our handpicked selection of certified organic food and
                non-food products that nourish your body and soul.</p>
            <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                <button
                    class="btn-primary px-8 py-4 rounded-lg font-medium text-lg flex items-center justify-center">
                    Shop Now <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>

    <a href="#features" class="scroll-down text-white text-2xl">
        <i class="fas fa-chevron-down"></i>
    </a>
</section>
</template>

<script>
export default {
    name: 'HeroSection',
};
</script>
