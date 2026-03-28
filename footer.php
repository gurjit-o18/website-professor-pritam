    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h5><i class="fas fa-graduation-cap me-2"></i>Professor Pritam Singh</h5>
                    <p class="mb-1">Emeritus Professor of Economics</p>
                    <p class="text-white-50">Oxford Brookes University, Oxford, UK</p>
                    <div class="d-flex gap-3 mt-3">
                        <?php
                        $bio_footer = @json_decode(@file_get_contents(__DIR__ . '/data/bio.json'), true);
                        if (!empty($bio_footer['google_scholar_url'])): ?>
                        <a href="<?= htmlspecialchars($bio_footer['google_scholar_url']) ?>" target="_blank" title="Google Scholar"><i class="fas fa-graduation-cap fa-lg"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($bio_footer['academia_url'])): ?>
                        <a href="<?= htmlspecialchars($bio_footer['academia_url']) ?>" target="_blank" title="Academia.edu"><i class="fas fa-university fa-lg"></i></a>
                        <?php endif; ?>
                        <?php if (!empty($bio_footer['institution_profile_url'])): ?>
                        <a href="<?= htmlspecialchars($bio_footer['institution_profile_url']) ?>" target="_blank" title="University Profile"><i class="fas fa-building-columns fa-lg"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><a href="about.php"><i class="fas fa-chevron-right me-1 small"></i>About</a></li>
                        <li class="mb-2"><a href="books.php"><i class="fas fa-chevron-right me-1 small"></i>Books</a></li>
                        <li class="mb-2"><a href="articles.php"><i class="fas fa-chevron-right me-1 small"></i>Articles</a></li>
                        <li class="mb-2"><a href="conferences.php"><i class="fas fa-chevron-right me-1 small"></i>Conferences</a></li>
                        <li class="mb-2"><a href="contact.php"><i class="fas fa-chevron-right me-1 small"></i>Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h5>Contact</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><i class="fas fa-envelope me-2 text-white-50"></i>psingh@brookes.ac.uk</li>
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2 text-white-50"></i>Oxford Brookes Business School</li>
                        <li class="mb-2"><i class="fas fa-globe me-2 text-white-50"></i>Oxford, UK</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center">
                <p class="mb-0 text-white-50 small">&copy; <?= date('Y') ?> Professor Pritam Singh. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button class="scroll-top-btn" id="scrollTopBtn" aria-label="Scroll to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Scroll-to-top & scroll animations -->
    <script>
    (function(){
        var btn = document.getElementById('scrollTopBtn');
        if (btn) {
            window.addEventListener('scroll', function(){
                btn.classList.toggle('visible', window.scrollY > 300);
            });
            btn.addEventListener('click', function(){
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries){
                entries.forEach(function(e){
                    if (e.isIntersecting) {
                        e.target.classList.add('animate-fade-in-up');
                        observer.unobserve(e.target);
                    }
                });
            }, { threshold: 0.08 });
            document.querySelectorAll('.card, .book-item, .article-item, .video-item, .section-title, h2, h3').forEach(function(el){
                if (!el.closest('.hero-section') && !el.closest('nav')) {
                    el.style.opacity = '0';
                    observer.observe(el);
                }
            });
        }
    })();
    </script>
</body>
</html>
