<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; <?= date('Y') ?></div>
            <div>
                <a href="#">Tentang Aplikasi</a>
                &middot;
                <a href="#">Saran &amp; Bantuan</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script>
    // JavaScript to toggle the submenu visibility
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach((item) => {
        item.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });
    
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/datatables-simple-demo.js"></script>