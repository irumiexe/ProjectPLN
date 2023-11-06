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
<script>
    // Ambil data dari tabel tbl_pelanggan berdasarkan tanggal (gantilah dengan query yang sesuai)
    // Misalnya, Anda dapat mengambil data dari tanggal tertentu:
    <?php
    $queryDataPelanggan = $db->query("SELECT tanggal, COUNT(*) as jumlah_pelanggan FROM tbl_pelanggan GROUP BY tanggal");
    $dataPelanggan = $queryDataPelanggan->fetch_all(MYSQLI_ASSOC);
    ?>

    // Data untuk grafik
    var dates = <?php echo json_encode(array_column($dataPelanggan, 'tanggal')); ?>;
    var jumlahPelanggan = <?php echo json_encode(array_column($dataPelanggan, 'jumlah_pelanggan')); ?>;

    // Inisialisasi dan gambar grafik menggunakan Chart.js
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line', // Jenis grafik (misalnya, line untuk grafik garis)
        data: {
            labels: dates, // Label sumbu X (tanggal)
            datasets: [{
                label: 'Jumlah Pelanggan',
                data: jumlahPelanggan, // Data jumlah pelanggan
                borderColor: 'rgb(75, 192, 192)', // Warna garis
                borderWidth: 2,
                fill: false // Jangan isi area di bawah garis
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'time', // Jenis sumbu X adalah waktu
                    time: {
                        unit: 'day' // Satuan waktu (hari)
                    },
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Pelanggan'
                    }
                }
            }
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script type="text/javascript" src="../assets/js/datatables-simple-demo.js"></script>