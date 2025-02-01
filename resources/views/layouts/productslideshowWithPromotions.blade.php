<main class="container mx-auto py-8 px-6">
    <!-- Slideshow Section -->
    <div class="relative w-full max-w-4xl mx-auto overflow-hidden rounded-lg shadow-lg" style="width: 800px; height: 400px;">
        <!-- Slides -->
        <div class="relative flex transition-transform duration-500" x-data="{ currentSlide: 0 }" 
             x-init="setInterval(() => currentSlide = (currentSlide + 1) % 3, 5000)" 
             x-effect="document.querySelector('.slides').style.transform = `translateX(-${currentSlide * 100}%)`;">
             
            <div class="slides flex w-full">
                <!-- Slide 1 -->
                <div class="flex-shrink-0 w-full h-full">
                    <img src="{{ asset('images/slide1.jpg') }}" alt="Slide 1" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black to-transparent text-white">
                        <h2 class="text-xl font-bold">High-Quality Caps</h2>
                        <p>Perfectly designed for any occasion.</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="flex-shrink-0 w-full h-full">
                    <img src="{{ asset('images/slide2.jpg') }}" alt="Slide 2" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black to-transparent text-white">
                        <h2 class="text-xl font-bold">Custom Designs</h2>
                        <p>Make it truly yours with our customization options.</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="flex-shrink-0 w-full h-full">
                    <img src="{{ asset('images/slide3.jpg') }}" alt="Slide 3" class="w-full h-full object-cover">
                    <div class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black to-transparent text-white">
                        <h2 class="text-xl font-bold">Shop Now</h2>
                        <p>Discover your perfect style today.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Dots -->
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
            <button 
                :class="{'bg-yellow-500': currentSlide === 0, 'bg-white': currentSlide !== 0}" 
                class="w-3 h-3 rounded-full" 
                x-on:click="currentSlide = 0"></button>
            <button 
                :class="{'bg-yellow-500': currentSlide === 1, 'bg-white': currentSlide !== 1}" 
                class="w-3 h-3 rounded-full" 
                x-on:click="currentSlide = 1"></button>
            <button 
                :class="{'bg-yellow-500': currentSlide === 2, 'bg-white': currentSlide !== 2}" 
                class="w-3 h-3 rounded-full" 
                x-on:click="currentSlide = 2"></button>
        </div>
    </div>
