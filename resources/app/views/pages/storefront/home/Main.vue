<template>
    <main class="storefront-home" @click="handleAnchorClick">
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
        
            <!-- Categories Carousel -->
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
        
            <!-- Featured Products -->
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
        
            <!-- Three Column Product Listing Section -->
            <section class="py-12 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Column 1: Trending Products -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200 heading-font">Trending
                                Products</h3>
                            <div class="space-y-4">
                                <!-- Product 1 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1610450949065-1f2841536c88?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Organic Chocolate" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Dark Organic Chocolate</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$7.99</p>
                                    </div>
                                </div>
        
                                <!-- Product 2 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1617093727343-374698b1b08d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Organic Coffee" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Arabica Coffee</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$12.99</p>
                                    </div>
                                </div>
        
                                <!-- Product 3 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1474979266404-7eaacbcd87c5?q=80&w=418&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3Dauto=format&fit=crop&w=200&q=80"
                                        alt="Olive Oil" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Extra Virgin Olive Oil</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$19.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Column 2: Recently Added -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200 heading-font">Recently
                                Added</h3>
                            <div class="space-y-4">
                                <!-- Product 1 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1594035910387-fea47794261f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Granola" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Organic Granola</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$8.99</p>
                                    </div>
                                </div>
        
                                <!-- Product 2 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1550583724-b2692b85b150?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Yogurt" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Greek Yogurt</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$4.99</p>
                                    </div>
                                </div>
        
                                <!-- Product 3 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Wine" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Organic Red Wine</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$24.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
        
                        <!-- Column 3: Top Rated Products -->
                        <div class="bg-white rounded-xl shadow-sm p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-6 pb-2 border-b border-gray-200 heading-font">Top
                                Rated</h3>
                            <div class="space-y-4">
                                <!-- Product 1 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1587049352851-8d4e89133924?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=NHwxMjA3fDA%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Honey" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Raw Organic Honey</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$12.99</p>
                                    </div>
                                </div>
        
                                <!-- Product 2 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://plus.unsplash.com/premium_photo-1675237625910-e5d354c03987?q=80&w=387&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Almonds" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Organic Almonds</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$8.99</p>
                                    </div>
                                </div>
        
                                <!-- Product 3 -->
                                <div class="flex items-center gap-4 hover:bg-gray-50 p-2 rounded-lg transition">
                                    <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&h=200&q=80"
                                        alt="Skincare" class="w-16 h-16 object-cover rounded-lg">
                                    <div>
                                        <h4 class="font-medium text-gray-800">Organic Skincare Set</h4>
                                        <div class="rating-stars text-yellow-400 text-xs mb-1">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                        <p class="text-green-700 font-bold">$39.99</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        
            <!-- Features Section -->
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
        
            <!-- Parallax Banner -->
            <section class="py-24 bg-fixed parallax-bg"
                style="background-image: url('https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');">
                <div class="container mx-auto px-4 text-center text-white">
                    <div class="max-w-2xl mx-auto bg-black bg-opacity-50 p-8 rounded-xl backdrop-blur-sm">
                        <span class="text-green-300 font-medium mb-2 inline-block">Healthy Living</span>
                        <h2 class="text-3xl md:text-4xl font-bold mb-4 heading-font">Nourish Your Body Naturally</h2>
                        <p class="text-lg mb-6">Our organic products are carefully sourced to provide the highest quality
                            nutrition for you and your family.</p>
                        <button class="btn-primary px-8 py-3 rounded-lg font-medium text-lg">
                            Discover More <i class="fas fa-arrow-right ml-2"></i>
                        </button>
                    </div>
                </div>
            </section>
        
            <!-- Popular Products -->
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
        
            <!-- Special Offers Section -->
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
        
            <!-- Testimonials -->
            <section class="py-16 bg-white">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-12">
                        <span class="text-green-700 font-medium mb-2 inline-block">Testimonials</span>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3 heading-font">What Our Customers Say</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">Hear from people who have experienced the Revonna Organics
                            difference</p>
                    </div>
        
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- Testimonial 1 -->
                        <div class="testimonial-card bg-gray-50 p-8 rounded-xl hover:shadow-lg">
                            <div class="rating-stars mb-4">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-gray-700 mb-6 italic">"I've been shopping with Revonna Organics for over a year now
                                and their products have transformed my family's health. The quality is exceptional and their
                                customer service is outstanding."</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson"
                                    class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <h4 class="font-bold">Sarah Johnson</h4>
                                    <p class="text-gray-600 text-sm">Verified Customer</p>
                                </div>
                            </div>
                        </div>
        
                        <!-- Testimonial 2 -->
                        <div class="testimonial-card bg-gray-50 p-8 rounded-xl hover:shadow-lg">
                            <div class="rating-stars mb-4">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="text-gray-700 mb-6 italic">"As someone with sensitive skin, finding organic products that
                                work has been challenging. Revonna's skincare line is gentle yet effective. I'm a customer for
                                life!"</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen"
                                    class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <h4 class="font-bold">Michael Chen</h4>
                                    <p class="text-gray-600 text-sm">Verified Customer</p>
                                </div>
                            </div>
                        </div>
        
                        <!-- Testimonial 3 -->
                        <div class="testimonial-card bg-gray-50 p-8 rounded-xl hover:shadow-lg">
                            <div class="rating-stars mb-4">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="text-gray-700 mb-6 italic">"The organic groceries from Revonna are consistently fresh and
                                delicious. Their commitment to sustainability aligns with my values. Highly recommend their
                                seasonal produce boxes!"</p>
                            <div class="flex items-center">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Emily Rodriguez"
                                    class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <h4 class="font-bold">Emily Rodriguez</h4>
                                    <p class="text-gray-600 text-sm">Verified Customer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        
            <!-- Instagram Feed -->
            <section class="py-12 bg-white">
                <div class="container mx-auto px-4">
                    <div class="text-center mb-8">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2 heading-font">Follow Us @RevonnaOrganics</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">Tag us in your photos for a chance to be featured!</p>
                    </div>
        
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-1">
                        <a href="#" class="group relative overflow-hidden h-40">
                            <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80"
                                alt="Instagram post"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-brands fa-instagram text-white text-2xl"></i>
                            </div>
                        </a>
                        <a href="#" class="group relative overflow-hidden h-40">
                            <img src="https://images.unsplash.com/photo-1594824476967-48c8b964273f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1974&q=80"
                                alt="Instagram post"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-brands fa-instagram text-white text-2xl"></i>
                            </div>
                        </a>
                        <a href="#" class="group relative overflow-hidden h-40">
                            <img src="https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                alt="Instagram post"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-brands fa-instagram text-white text-2xl"></i>
                            </div>
                        </a>
                        <a href="#" class="group relative overflow-hidden h-40">
                            <img src="https://images.unsplash.com/photo-1605000797499-95a51c5269ae?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80"
                                alt="Instagram post"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-brands fa-instagram text-white text-2xl"></i>
                            </div>
                        </a>
                        <a href="#" class="group relative overflow-hidden h-40">
                            <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                alt="Instagram post"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-brands fa-instagram text-white text-2xl"></i>
                            </div>
                        </a>
                        <a href="#" class="group relative overflow-hidden h-40">
                            <img src="https://images.unsplash.com/photo-1547592180-85f173990554?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80"
                                alt="Instagram post"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div
                                class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                <i class="fa-brands fa-instagram text-white text-2xl"></i>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
    </main>
</template>

<script>
export default {
    name: 'StorefrontHome',
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
