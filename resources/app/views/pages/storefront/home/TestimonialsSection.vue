<template>
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
</template>

<script>
export default {
    name: 'TestimonialsSection',
};
</script>
