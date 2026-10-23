<template>
    <footer class="bg-gray-900 text-white pt-16 pb-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-12">
                    <!-- Column 1 -->
                    <div class="lg:col-span-2">
                        <router-link to="/" class="mb-4 inline-flex items-center">
                            <img
                                src="/assets/revonna/revonnalogo.png"
                                alt="Revonna Organics"
                                class="storefront-footer-logo h-16 w-auto"
                            >
                        </router-link>
                        <p class="text-gray-400 mb-6">Committed to providing the highest quality organic products for a
                            healthier you and a healthier planet.</p>
                        <div class="flex space-x-4">
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-green-700 hover:text-white transition">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-green-700 hover:text-white transition">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-green-700 hover:text-white transition">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-gray-800 rounded-full flex items-center justify-center text-gray-300 hover:bg-green-700 hover:text-white transition">
                                <i class="fa-brands fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
    
                    <!-- Column 2 -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Quick Links</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Home</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">About Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Shop</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Blog</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Contact</a></li>
                        </ul>
                    </div>
    
                    <!-- Column 3 -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Customer Service</h3>
                        <ul class="space-y-3">
                            <li><a href="#" class="text-gray-400 hover:text-white transition">My Account</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Order Tracking</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Wishlist</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Shipping Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition">Returns & Refunds</a></li>
                        </ul>
                    </div>
    
                    <!-- Column 4 -->
                    <div>
                        <h3 class="text-lg font-bold mb-4">Contact Info</h3>
                        <ul class="space-y-3 text-gray-400">
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-600"></i>
                                <span>123 Organic Way, Portland, OR 97201</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-phone-alt mr-3 text-green-600"></i>
                                <span>+1 (234) 567-8900</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-envelope mr-3 text-green-600"></i>
                                <span>revonnaorganics@gmail.com</span>
                            </li>
                            <li class="flex items-center">
                                <i class="fas fa-clock mr-3 text-green-600"></i>
                                <span>Mon-Fri: 9AM - 6PM</span>
                            </li>
                        </ul>
                    </div>
                </div>
    
                <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 Revonna Organics. All rights reserved.</p>
                    <div class="flex space-x-4">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg"
                            alt="Google Pay" class="h-8">
                    </div>
                </div>
            </div>
        </footer>
</template>

<script>
export default {
    name: 'StorefrontFooter',
};
</script>
