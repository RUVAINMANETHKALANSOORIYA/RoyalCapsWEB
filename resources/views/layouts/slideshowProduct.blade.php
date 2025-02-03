 <!-- Hero Section with Slideshow -->
 <div class="relative w-full h-[600px] overflow-hidden">
    <div class="absolute inset-0">
        <div class="slideshow" x-data="{ currentSlide: 0 }" x-init="setInterval(() => currentSlide = (currentSlide + 1) % 3, 5000)">
            <img class="slide h-full w-full object-cover absolute transition-opacity duration-1000" 
                 :class="{ 'opacity-100': currentSlide === 0, 'opacity-0': currentSlide !== 0 }" 
                 src="{{ asset('images/home1.jpg') }}" alt="Slideshow Image 1">
            <img class="slide h-full w-full object-cover absolute transition-opacity duration-1000" 
                 :class="{ 'opacity-100': currentSlide === 1, 'opacity-0': currentSlide !== 1 }" 
                 src="{{ asset('images/home2.jpg') }}" alt="Slideshow Image 2">
            <img class="slide h-full w-full object-cover absolute transition-opacity duration-1000" 
                 :class="{ 'opacity-100': currentSlide === 2, 'opacity-0': currentSlide !== 2 }" 
                 src="{{ asset('images/home3.jpg') }}" alt="Slideshow Image 3">
        </div>
    </div>

    <!-- Hero Content -->
    <div class="absolute inset-0 flex flex-col justify-center items-center text-center text-white bg-gradient-to-b from-black/40 to-black/70">
        <h1 class="text-5xl font-bold mb-6 tracking-tight animate-fade-in">
            Exlussive Products
        </h1>
        <p class="text-lg mb-6">
            Discover the finest collection of royal caps. <br>Each piece is crafted with precision and elegance, 
            reflecting <br>the rich heritage and timeless style. Start your journey to find the perfect cap today.
        </p>
        <a href="/products" class="mt-8 px-8 py-3 bg-white text-black rounded-full hover:bg-opacity-90 transition-all duration-300 font-semibold animate-bounce">
            Explore Now
        </a>
    </div>
</div>
