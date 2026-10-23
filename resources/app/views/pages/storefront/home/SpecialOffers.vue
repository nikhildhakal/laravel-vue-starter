<template>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-700 font-medium mb-2 inline-block">Limited Time Offers</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 heading-font">Special Discounts</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Don't miss these exclusive deals on our premium organic
                products</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Product 1 -->
            <div
                class="product-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 hover:border-green-200 transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1617093727343-374698b1b08d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Organic Coffee" class="w-full h-64 object-cover transition duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">-20%
                            OFF</span>
                    </div>
                    <button
                        class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-green-800 shadow-md transition">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Organic Arabica Coffee</h3>
                            <span class="text-gray-500 text-sm">500g Ground Coffee</span>
                        </div>
                        <div class="text-right">
                            <span class="text-green-800 font-bold text-lg">$14.99</span>
                            <span class="text-gray-400 line-through text-sm block">$18.99</span>
                        </div>
                    </div>
                    <div class="rating-stars mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-gray-500 text-sm ml-1">(87)</span>
                    </div>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-3 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-12 h-12 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div
                class="product-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 hover:border-green-200 transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1610450949065-1f2841536c88?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Organic Chocolate" class="w-full h-64 object-cover transition duration-500">
                    <div class="absolute top-3 left-3">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">BESTSELLER</span>
                    </div>
                    <button
                        class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-green-800 shadow-md transition">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Dark Organic Chocolate</h3>
                            <span class="text-gray-500 text-sm">85% Cocoa, 200g Bar</span>
                        </div>
                        <div class="text-right">
                            <span class="text-green-800 font-bold text-lg">$7.99</span>
                        </div>
                    </div>
                    <div class="rating-stars mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-gray-500 text-sm ml-1">(124)</span>
                    </div>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-3 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-12 h-12 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div
                class="product-card bg-white rounded-xl overflow-hidden shadow-md border border-gray-100 hover:border-green-200 transition-all duration-300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2080&q=80"
                        alt="Organic Granola" class="w-full h-64 object-cover transition duration-500">
                    <div class="absolute top-3 left-3">
                        <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full">NEW</span>
                    </div>
                    <button
                        class="absolute top-3 right-3 w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-green-800 shadow-md transition">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-2">
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg">Organic Granola Mix</h3>
                            <span class="text-gray-500 text-sm">With Nuts & Berries, 500g</span>
                        </div>
                        <div class="text-right">
                            <span class="text-green-800 font-bold text-lg">$9.99</span>
                        </div>
                    </div>
                    <div class="rating-stars mb-4">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="text-gray-500 text-sm ml-1">(56)</span>
                    </div>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-3 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-12 h-12 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <button class="btn-secondary px-8 py-3 rounded-lg font-medium text-lg">
                View All Deals <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'SpecialOffers',
};
</script>
