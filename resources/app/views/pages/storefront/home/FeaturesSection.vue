<template>
<section class="py-10 bg-green-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-700 font-medium mb-2 inline-block">Why Choose Us</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 heading-font">Our Organic Promise</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">We're committed to bringing you the purest organic products
                with exceptional service</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 max-w-5xl mx-auto">
            <!-- Feature 1 -->
            <div
                class="feature-box bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 border border-green-100">
                <div
                    class="feature-icon bg-green-100 p-3 rounded-full mb-4 text-green-800 text-xl w-12 h-12 flex items-center justify-center mx-auto">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="font-bold text-lg mb-2 text-center">100% Organic</h3>
                <p class="text-gray-600 text-sm text-center">Certified organic products with no artificial additives
                </p>
            </div>

            <!-- Feature 2 -->
            <div
                class="feature-box bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 border border-green-100">
                <div
                    class="feature-icon bg-green-100 p-3 rounded-full mb-4 text-green-800 text-xl w-12 h-12 flex items-center justify-center mx-auto">
                    <i class="fas fa-truck"></i>
                </div>
                <h3 class="font-bold text-lg mb-2 text-center">Free Shipping</h3>
                <p class="text-gray-600 text-sm text-center">On all orders over $50 within the US</p>
            </div>

            <!-- Feature 3 -->
            <div
                class="feature-box bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 border border-green-100">
                <div
                    class="feature-icon bg-green-100 p-3 rounded-full mb-4 text-green-800 text-xl w-12 h-12 flex items-center justify-center mx-auto">
                    <i class="fas fa-undo"></i>
                </div>
                <h3 class="font-bold text-lg mb-2 text-center">Easy Returns</h3>
                <p class="text-gray-600 text-sm text-center">30-day return policy for all products</p>
            </div>

            <!-- Feature 4 -->
            <div
                class="feature-box bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-all duration-300 border border-green-100">
                <div
                    class="feature-icon bg-green-100 p-3 rounded-full mb-4 text-green-800 text-xl w-12 h-12 flex items-center justify-center mx-auto">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="font-bold text-lg mb-2 text-center">24/7 Support</h3>
                <p class="text-gray-600 text-sm text-center">Dedicated customer service team</p>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'FeaturesSection',
};
</script>
