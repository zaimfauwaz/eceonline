<!-- Footer -->
<footer class="bg-dark text-light py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <h5 class="text-white mb-4">Disclaimer</h5>
                <p class="text-white">Please note that all information shown in the catalog menu are for demonstration purposes only.</p>
            </div>
            <div class="col-lg-4">
                <h5 class="text-white mb-4">Quick Links</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('car.index') }}" class="text-white text-decoration-none mb-2 d-block">Available Cars</a></li>
                    <li><a href="{{ route('booking.index') }}" class="text-white text-decoration-none mb-2 d-block">Book a Car</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h5 class="text-white mb-4">Contact Info</h5>
                <p class="text-white mb-2"><i class="fas fa-building me-3"></i>HQ Branch: {{ $mainBranch->branch_name }}</p>
                <p class="text-white mb-2"><i class="fas fa-map-marker-alt me-3"></i>{{ $mainBranch->branch_location }}</p>
                <p class="text-white mb-2"><i class="fas fa-phone me-3"></i>+60 123 456 7890</p>
                <p class="text-white mb-4"><i class="fas fa-envelope me-3"></i>info@eceonline.com</p>
            </div>
        </div>
    </div>
</footer>