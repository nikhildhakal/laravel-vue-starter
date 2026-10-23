<template>
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <span class="text-green-700 font-medium mb-2 inline-block">Customer Favorites</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 heading-font">Popular Products</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Our customers' favorite organic products</p>
        </div>

        <!-- Splide Slider -->
        <div class="splide product-splide" aria-label="Popular Products">
            <div class="splide__track">
                <ul class="splide__list">
                    <!-- Product 1 -->
                    <li class="splide__slide px-2">
                        <div class="product-card bg-white rounded-xl overflow-hidden shadow-md h-full">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1586201375799-47cd24c3f595?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D"
                                    alt="Organic Quinoa" class="w-full h-64 object-cover transition duration-500">
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">Organic Quinoa</h3>
                                    <span class="text-green-800 font-bold text-lg">$6.99</span>
                                </div>
                                <div class="rating-stars mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="text-gray-500 text-sm ml-1">(89)</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">High-protein ancient grain from Peru</p>
                                <button
                                    class="w-full bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </li>

                    <!-- Product 2 -->
                    <li class="splide__slide px-2">
                        <div class="product-card bg-white rounded-xl overflow-hidden shadow-md h-full">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1558160074-4d7d8bdf4256?w=870&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D"
                                    alt="Organic Tea" class="w-full h-64 object-cover transition duration-500">
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">Organic Green Tea</h3>
                                    <span class="text-green-800 font-bold text-lg">$9.99</span>
                                </div>
                                <div class="rating-stars mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span class="text-gray-500 text-sm ml-1">(67)</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Antioxidant-rich leaves from Japan</p>
                                <button
                                    class="w-full bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </li>

                    <!-- Product 3 -->
                    <li class="splide__slide px-2">
                        <div class="product-card bg-white rounded-xl overflow-hidden shadow-md h-full">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1588413333412-82148535db53?w=870&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D"
                                    alt="Organic Coconut Oil"
                                    class="w-full h-64 object-cover transition duration-500">
                                <div class="absolute top-3 right-3">
                                    <span
                                        class="bg-green-100 text-green-800 text-xs font-bold px-3 py-1 rounded-full">BESTSELLER</span>
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">Organic Coconut Oil</h3>
                                    <span class="text-green-800 font-bold text-lg">$14.99</span>
                                </div>
                                <div class="rating-stars mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="text-gray-500 text-sm ml-1">(142)</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Cold-pressed virgin oil from Sri Lanka</p>
                                <button
                                    class="w-full bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </li>

                    <!-- Product 4 -->
                    <li class="splide__slide px-2">
                        <div class="product-card bg-white rounded-xl overflow-hidden shadow-md h-full">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                    alt="Organic Protein Powder"
                                    class="w-full h-64 object-cover transition duration-500">
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">Organic Protein Powder</h3>
                                    <span class="text-green-800 font-bold text-lg">$29.99</span>
                                </div>
                                <div class="rating-stars mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <span class="text-gray-500 text-sm ml-1">(56)</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Plant-based protein with 5 superfoods</p>
                                <button
                                    class="w-full bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </li>

                    <!-- Product 5 -->
                    <li class="splide__slide px-2">
                        <div class="product-card bg-white rounded-xl overflow-hidden shadow-md h-full">
                            <div class="relative overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                    alt="Organic Spices" class="w-full h-64 object-cover transition duration-500">
                            </div>
                            <div class="p-5">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-gray-800 text-lg">Organic Spices Set</h3>
                                    <span class="text-green-800 font-bold text-lg">$24.99</span>
                                </div>
                                <div class="rating-stars mb-3">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <span class="text-gray-500 text-sm ml-1">(34)</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">12 essential spices for your kitchen</p>
                                <button
                                    class="w-full bg-green-800 hover:bg-green-700 text-white py-2 rounded-md transition duration-300">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
</template>

<script>
export default {
    name: 'PopularProducts',
};
</script>
