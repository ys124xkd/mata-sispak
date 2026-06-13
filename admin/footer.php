<head>
    <!-- Link ke Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<style>
.footer {
    background-color: #2c3e50;
    color: #ecf0f1;
    padding: 20px 0;
    font-family: Arial, sans-serif;
}

.footer .footer-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer .footer-section {
    flex: 1;
    margin: 10px;
    min-width: 250px;
}

.footer .footer-section h3, 
.footer .footer-section h4 {
    margin-bottom: 15px;
    font-size: 18px;
    border-bottom: 2px solid #ecf0f1;
    padding-bottom: 5px;
}

.footer .footer-section p, 
.footer .footer-section ul {
    margin: 0;
    padding: 0;
    line-height: 1.6;
}

.footer .footer-section ul {
    list-style: none;
}

.footer .footer-section ul li {
    margin-bottom: 10px;
}

.footer .footer-section ul li a {
    text-decoration: none;
    color: #ecf0f1;
    transition: color 0.3s ease;
}

.footer .footer-section ul li a:hover {
    color: #3498db;
}

.footer .footer-section ul li i {
    margin-right: 10px;
}

.footer .footer-bottom {
    text-align: center;
    margin-top: 20px;
    padding-top: 10px;
    border-top: 1px solid #7f8c8d;
    font-size: 14px;
}

@media (max-width: 768px) {
    .footer .footer-content {
        flex-direction: column;
    }
}
</style>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-section about">
            <h3>Sistem Pakar Penyakit Mata</h3>
            <p>
                Aplikasi ini menggunakan metode forward chaining untuk membantu mendiagnosa penyakit mata 
                berdasarkan gejala yang Anda masukkan.
            </p>
        </div>
        <div class="footer-section links">
            <h4>Ikuti Kami</h4>
            <ul>
                <li><a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i>YouTube</a></li>
                <li><a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i>Instagram</a></li>
                <li><a href="https://wa.me/6285891054464"  target="_blank"><i class="fab fa-whatsapp"></i>WhatsApp</a></li>
                <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i>Twitter</a></li>
            </ul>
        </div>
        <div class="footer-section contact">
            <h4>Kontak</h4>
            <p>Email: DiagnosaSistemPakar123@gmail.com</p>
            <p>Telepon: +62 858 9105 4464</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Sistem Pakar Penyakit Mata | Semua Hak Dilindungi</p>
    </div>
</footer>
