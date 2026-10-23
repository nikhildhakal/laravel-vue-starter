<template>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-700 font-medium mb-2 inline-block">Our Products</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 heading-font">Featured Products</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Our carefully selected organic products that promote wellness
                and sustainability</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Product 1 -->
            <div class="product-card bg-white rounded-xl overflow-hidden shadow-md relative">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1587049352851-8d4e89133924?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D&auto=format&fit=crop&w=2070&q=80"
                        alt="Organic Honey" class="w-full h-64 object-cover transition duration-500">
                    <div class="absolute top-3 right-3 flex flex-col space-y-2">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">NEW</span>
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">-15%</span>
                    </div>
                    <button
                        class="absolute bottom-3 left-1/2 transform -translate-x-1/2 bg-white text-green-800 px-4 py-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition duration-300 flex items-center">
                        <i class="fas fa-eye mr-2"></i> Quick View
                    </button>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-800 text-lg">Raw Organic Honey</h3>
                        <div>
                            <span class="text-green-800 font-bold text-lg">$12.99</span>
                            <span class="text-gray-400 line-through text-sm block">$15.99</span>
                        </div>
                    </div>
                    <div class="rating-stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-gray-500 text-sm ml-1">(48)</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Pure, unfiltered honey from local organic beekeepers</p>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-10 h-10 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="product-card bg-white rounded-xl overflow-hidden shadow-md relative">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?q=80&w=418&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3Dauto=format&fit=crop&w=1974&q=80"
                        alt="Organic Olive Oil" class="w-full h-64 object-cover transition duration-500">
                    <div class="absolute top-3 right-3">
                        <span class="bg-red-100 text-red-800 text-xs font-bold px-3 py-1 rounded-full">SALE</span>
                    </div>
                    <button
                        class="absolute bottom-3 left-1/2 transform -translate-x-1/2 bg-white text-green-800 px-4 py-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition duration-300 flex items-center">
                        <i class="fas fa-eye mr-2"></i> Quick View
                    </button>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-800 text-lg">Extra Virgin Olive Oil</h3>
                        <div>
                            <span class="text-green-800 font-bold text-lg">$19.99</span>
                            <span class="text-gray-400 line-through text-sm block">$24.99</span>
                        </div>
                    </div>
                    <div class="rating-stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                        <span class="text-gray-500 text-sm ml-1">(36)</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Cold-pressed from organic olives in Greece</p>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-10 h-10 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="product-card bg-white rounded-xl overflow-hidden shadow-md relative">
                <div class="relative overflow-hidden">
                    <img src="https://plus.unsplash.com/premium_photo-1675237625910-e5d354c03987?q=80&w=387&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3Dauto=format&fit=crop&w=2070&q=80"
                        alt="Organic Almonds" class="w-full h-64 object-cover transition duration-500">
                    <button
                        class="absolute bottom-3 left-1/2 transform -translate-x-1/2 bg-white text-green-800 px-4 py-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition duration-300 flex items-center">
                        <i class="fas fa-eye mr-2"></i> Quick View
                    </button>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-800 text-lg">Raw Organic Almonds</h3>
                        <span class="text-green-800 font-bold text-lg">$8.99</span>
                    </div>
                    <div class="rating-stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <span class="text-gray-500 text-sm ml-1">(72)</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">California grown, non-GMO, packed with nutrients</p>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-10 h-10 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="product-card bg-white rounded-xl overflow-hidden shadow-md relative">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80"
                        alt="Organic Skincare Set" class="w-full h-64 object-cover transition duration-500">
                    <div class="absolute top-3 right-3">
                        <span
                            class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">BESTSELLER</span>
                    </div>
                    <button
                        class="absolute bottom-3 left-1/2 transform -translate-x-1/2 bg-white text-green-800 px-4 py-2 rounded-full shadow-md opacity-0 group-hover:opacity-100 transition duration-300 flex items-center">
                        <i class="fas fa-eye mr-2"></i> Quick View
                    </button>
                </div>
                <div class="p-5">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="font-bold text-gray-800 text-lg">Organic Skincare Set</h3>
                        <span class="text-green-800 font-bold text-lg">$39.99</span>
                    </div>
                    <div class="rating-stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                        <span class="text-gray-500 text-sm ml-1">(124)</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">Complete facial care with natural ingredients</p>
                    <div class="flex space-x-2">
                        <button
                            class="flex-1 bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300 flex items-center justify-center">
                            <i class="fas fa-shopping-cart mr-2"></i> Add to Cart
                        </button>
                        <button
                            class="w-10 h-10 border border-gray-200 rounded-md flex items-center justify-center text-gray-600 hover:bg-gray-100 transition">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12">
            <button class="btn-secondary px-8 py-3 rounded-lg font-medium text-lg">
                View All Products <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'FeaturedProducts',
};
</script>
