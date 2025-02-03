<!-- filepath: /d:/RoyalCAPS/RoyalCaps/resources/views/layouts/footer.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        
        footer {
            background-color: #2d3748;
            color: white;
            padding: 1rem 0;
            text-align: center;
            width: 100%;
        }
    </style>
</head>
<body>
    <!-- Wrapper to push content above footer -->
    <div class="content-wrapper">
        <!-- Main Content -->
        <div class="flex-grow">
            @yield('content') <!-- This ensures your page content takes available space -->
        </div>

        <!-- Footer (Fixed at Bottom) -->
        <footer>
            <div class="container mx-auto text-center">
                <p>&copy; {{ date('Y') }} Royal Caps. All rights reserved.</p>
                <p class="mt-2">
                    <a href="{{ route('welcome') }}" class="hover:text-yellow-400">Home</a> | 
                    <a href="{{ route('products') }}" class="hover:text-yellow-400">Products</a> | 
                    <a href="{{ route('customization') }}" class="hover:text-yellow-400">Customization</a> | 
                    <a href="{{ route('about-us') }}" class="hover:text-yellow-400">About Us</a>
                </p>
            </div>
        </footer>
    </div>
</body>
</html>