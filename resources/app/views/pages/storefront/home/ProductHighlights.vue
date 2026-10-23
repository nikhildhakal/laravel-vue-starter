<template>
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
</template>

<script>
export default {
    name: 'ProductHighlights',
};
</script>
