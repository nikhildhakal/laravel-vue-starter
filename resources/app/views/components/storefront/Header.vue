<template>
    <div class="storefront-header" @keydown.esc.window="closeMenu">
        <!-- Top Bar -->
            <div class="bg-gradient-to-r from-green-800 to-green-700 text-white py-2 px-4 shadow-sm">
                <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
                    <div class="flex space-x-4 text-sm mb-2 md:mb-0">
                        <span class="flex items-center"><i class="fas fa-phone-alt mr-2 text-green-300"></i> +1 (234)
                            567-8900</span>
                        <span class="flex items-center"><i class="fas fa-envelope mr-2 text-green-300"></i>
                            hello@revonnaorganics.com</span>
                    </div>
                    <div class="flex space-x-4">
                        <span class="text-xs md:text-sm">Free shipping on orders over $50</span>
                        <div class="hidden md:flex space-x-3 ml-4">
                            <a href="#" class="hover:text-green-300 transition"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="hover:text-green-300 transition"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#" class="hover:text-green-300 transition"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="hover:text-green-300 transition"><i class="fa-brands fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Header -->
            <header class="bg-white shadow-sm sticky top-0 z-50">
                <div class="container mx-auto px-4 py-3 flex justify-between items-center">
                    <div class="flex items-center">
                        <router-link to="/" class="flex items-center">
                            <img src="/assets/revonna/revonnalogo.png" alt="Revonna Organics" class="h-16 w-auto mr-2">
                        </router-link>
                    </div>
        
                    <nav class="hidden lg:flex space-x-1">
                        <!-- Categories Dropdown -->
                        <div class="relative group">
                            <button class="nav-link px-4 py-3 text-gray-600 hover:text-green-800 flex items-center">
                                <span>Categories</span>
                                <i class="fas fa-chevron-down ml-2 text-xs"></i>
                            </button>
                            <div
                                class="absolute left-0 mt-0 w-64 bg-white shadow-lg rounded-md z-50 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300">
                                <ul class="space-y-2 p-4">
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Fresh Fruits</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Vegetables</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Dairy & Milks</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Baking Materials</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Grains & Cereals</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Beauty & Skincare</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Supplements</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Home Essentials</a></li>
                                    <li><a href="#" class="text-gray-600 hover:text-green-800 text-sm">Pet Care</a></li>
                                </ul>
                            </div>
                        </div>
        
                        <a href="#" class="nav-link px-4 py-3 text-gray-600 hover:text-green-800">Shop</a>
                        <a href="#" class="nav-link px-4 py-3 text-gray-600 hover:text-green-800">About</a>
                        <a href="#" class="nav-link px-4 py-3 text-gray-600 hover:text-green-800">Blog</a>
                        <a href="#" class="nav-link px-4 py-3 text-gray-600 hover:text-green-800">Contact</a>
                    </nav>
        
                    <button type="button" @click="openMenu" class="lg:hidden p-3 text-gray-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </header>
        
            <!-- Mobile Menu Content -->
            <!-- Mobile Menu Overlay and Content -->
            <div v-if="isMobileMenuOpen" @click="closeMenu" class="fixed inset-0 bg-black bg-opacity-50 z-40"></div>
            <div :class="isMobileMenuOpen ? 'translate-x-0' : 'translate-x-full'" class="fixed inset-y-0 right-0 w-4/5 max-w-sm bg-white z-50 shadow-xl transform transition-transform duration-300 ease-in-out overflow-y-auto">
                <div class="p-6 h-full flex flex-col">
                    <!-- Close Button -->
                    <button type="button" @click="closeMenu" class="self-end p-2 text-gray-600 hover:text-green-800 mb-6">
                        <i class="fas fa-times text-xl"></i>
                    </button>
        
                    <!-- Menu Content -->
                    <nav class="flex-grow" @click="closeMenu">
                        <ul class="space-y-4">
                            <li><a href="#"
                                    class="block py-2 text-lg font-medium text-gray-800 hover:text-green-700 border-b border-gray-100">Home</a>
                            </li>
                            <li><a href="#"
                                    class="block py-2 text-lg font-medium text-gray-800 hover:text-green-700 border-b border-gray-100">Shop</a>
                            </li>
                            <li><a href="#"
                                    class="block py-2 text-lg font-medium text-gray-800 hover:text-green-700 border-b border-gray-100">About
                                    Us</a></li>
                            <li><a href="#"
                                    class="block py-2 text-lg font-medium text-gray-800 hover:text-green-700 border-b border-gray-100">Blog</a>
                            </li>
                            <li><a href="#"
                                    class="block py-2 text-lg font-medium text-gray-800 hover:text-green-700 border-b border-gray-100">Contact</a>
                            </li>
                        </ul>
        
                        <div class="mt-8 pt-6 border-t border-gray-200">
                            <div class="flex space-x-4 justify-center">
                                <a href="#" class="text-gray-600 hover:text-green-800"><i
                                        class="fa-brands fa-facebook-f text-xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-green-800"><i
                                        class="fa-brands fa-instagram text-xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-green-800"><i
                                        class="fa-brands fa-twitter text-xl"></i></a>
                                <a href="#" class="text-gray-600 hover:text-green-800"><i
                                        class="fa-brands fa-pinterest text-xl"></i></a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
    </div>
</template>

<script>
export default {
    name: 'StorefrontHeader',
    data() {
        return {
            isMobileMenuOpen: false,
        };
    },
    methods: {
        openMenu() {
            this.isMobileMenuOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeMenu() {
            this.isMobileMenuOpen = false;
            document.body.style.overflow = '';
        },
    },
    beforeUnmount() {
        document.body.style.overflow = '';
    },
};
</script>
