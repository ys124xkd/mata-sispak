<!DOCTYPE html>
<html lang="id">
<head>
<?php include('../admin/bootstrap.php'); ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistem Pakar Kesehatan Mata</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            margin-bottom: 20px;
        }

        h1 {
            text-align: center; /* Center the title */
            background-color: blue; /* Blue background */
            color: white; /* White text color for contrast */
            padding: 20px; /* Padding around the text */
            margin: 0; /* Remove default margin */
        }

        .home-section {
            background: #fff;
            padding: 30px;
            margin: 20px 0;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .home-section:hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            color: #333;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }

        p, ul {
            line-height: 1.6;
        }
        .section-title {
            margin-top: 40px;
        }

        .section-content {
            margin-bottom: 20px;
            text-align: justify;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem Pakar Kesehatan Mata</h1>

        <main>
            <section id="latar-belakang" class="home-section">
                <h2 class="section-title">Latar Belakang</h2>
                <p class="section-content">
                    Mata merupakan salah satu organ tubuh yang berfungsi sebagai indra penglihatan dan merupakan bagian dari panca indra manusia. Fungsi mata sangat penting dalam menjalani aktivitas sehari-hari, seperti membaca, menulis, dan berjalan. Namun, sering kali kesehatan mata terabaikan, padahal gangguan atau penyakit pada mata dapat berdampak serius bagi kualitas hidup seseorang. Perlunya perhatian khusus terhadap kesehatan mata semakin mendesak, mengingat banyaknya faktor yang dapat mempengaruhi kondisi mata, seperti paparan sinar UV, penggunaan perangkat digital yang berlebihan, dan kurangnya pengetahuan masyarakat tentang cara merawat mata.
                </p>
                <p class="section-content">
                    Seiring dengan perkembangan teknologi yang pesat, pemanfaatan sistem pakar dalam bidang kesehatan menjadi sangat relevan. Sistem pakar dapat membantu dokter dalam mendiagnosa berbagai macam penyakit, termasuk penyakit mata, dengan lebih cepat dan akurat. Dengan aplikasi berbasis web ini, diharapkan masyarakat dapat lebih mudah mengakses informasi terkait kesehatan mata, sehingga dapat mencegah dan mengatasi masalah yang mungkin timbul sejak dini.
                </p>
            </section>

            <section id="tujuan" class="home-section">
                <h2 class="section-title">Tujuan Penelitian</h2>
                <ul class="section-content">
                    <li>Merancang dan mengimplementasikan sistem pakar yang digunakan untuk mendiagnosa penyakit mata menggunakan metode forward chaining untuk menghasilkan hasil yang akurat.</li>
                    <li>Mengidentifikasi dan mengklasifikasikan gejala-gejala utama dari berbagai penyakit mata untuk dijadikan basis pengetahuan dalam sistem pakar.</li>
                    <li>Merancang aturan-aturan (rules) yang efektif untuk mendukung proses inferensi dalam metode forward chaining agar menghasilkan diagnosa yang tepat.</li>
                    <li>Merancang antarmuka pengguna (user interface) yang intuitif dan mudah digunakan untuk membantu pengguna dalam memasukkan gejala dan mendapatkan hasil diagnosa dengan cepat.</li>
                </ul>
            </section>

            <section id="manfaat" class="home-section">
                <h2 class="section-title">Manfaat Penelitian</h2>
                <ul class="section-content">
                    <li>Penelitian ini dirancang menggunakan sistem pakar yang diharapkan dapat memberikan diagnosa yang lebih akurat dan cepat dibandingkan dengan metode tradisional, sehingga dapat membantu pengguna dalam menentukan langkah selanjutnya terkait dengan kesehatan mata mereka.</li>
                    <li>Dengan menggunakan metode forward chaining, sistem ini dapat memproses informasi lebih cepat, sehingga waktu yang diperlukan untuk mendapatkan diagnosa awal menjadi lebih singkat.</li>
                    <li>Penelitian ini berfungsi sebagai sumber informasi yang bermanfaat bagi masyarakat mengenai berbagai penyakit mata dan gejalanya, serta tindakan yang sebaiknya diambil.</li>
                    <li>Sistem ini dapat berfungsi sebagai alat bantu untuk tenaga medis dalam melakukan diagnosa, memberikan mereka informasi tambahan, dan mendukung dalam pengambilan keputusan yang lebih baik terhadap penanganan pasien.</li>
                </ul>
            </section>

            <section id="ruang-lingkup" class="home-section">
                <h2 class="section-title">Ruang Lingkup</h2>
                <p class="section-content">
                    Ruang lingkup penelitian ini mencakup pengembangan sistem pakar berbasis web untuk diagnosis penyakit mata menggunakan metode forward chaining. Dalam penelitian ini, fokus pada penciptaan sistem yang dapat mendiagnosa berbagai penyakit mata secara akurat berdasarkan gejala yang dilaporkan oleh pengguna. Metode forward chaining digunakan sebagai teknik inferensi untuk menganalisis informasi, di mana sistem memproses data gejala pengguna dan mencocokkannya dengan penyakit yang relevan melalui aturan logika. Proses ini menghasilkan diagnosis awal yang memberikan informasi kepada pengguna tentang kemungkinan penyakit dan langkah-langkah yang perlu diambil selanjutnya.
                </p>
                <p class="section-content">
                    Penelitian ini juga mencakup identifikasi dan klasifikasi gejala umum yang terkait dengan penyakit mata. Untuk membangun sistem pakar yang efektif, diperlukan basis pengetahuan komprehensif mengenai berbagai penyakit mata, seperti konjungtivitis, katarak, dan glaukoma, serta gejalanya. Informasi ini menjadi landasan untuk mengembangkan aturan yang mendukung sistem dalam melakukan diagnosis.
                </p>
                <p class="section-content">
                    Ruang lingkup penelitian ini meliputi perancangan aturan inferensi dalam bentuk logika IF-THEN, sehingga sistem dapat mencocokkan gejala yang dilaporkan pengguna dengan kemungkinan penyakit dan menghasilkan diagnosis yang tepat. Antarmuka pengguna (user interface) dirancang agar pengguna baik awam maupun profesional dapat dengan mudah memasukkan gejala dan menerima diagnosis. Desain harus efisien dan ramah pengguna, memastikan pengalaman yang baik dalam input data dan output diagnosis.
                </p>
                <p class="section-content">
                    Setelah tahap pengembangan sistem selesai, penelitian ini juga akan mencakup validasi dan pengujian untuk memastikan bahwa sistem berfungsi sesuai dengan harapan. Pengujian dilakukan untuk mengevaluasi akurasi diagnosa yang diberikan oleh sistem berdasarkan data gejala yang dimasukkan. Validasi dilakukan dengan membandingkan hasil diagnosa dari sistem pakar dengan hasil diagnosa yang diberikan oleh tenaga medis profesional, sehingga dapat dipastikan bahwa sistem ini mampu diandalkan.
                </p>
                <p class="section-content">
                    Ruang lingkup penelitian ini juga mencakup batasan-batasan yang ada dalam pengembangan sistem. Salah satu batasan adalah bahwa sistem pakar ini hanya dapat mendiagnosa penyakit mata yang umum dan tidak mencakup kondisi yang sangat jarang atau kompleks yang memerlukan intervensi dari spesialis mata. Sistem ini bertujuan untuk memberikan diagnosa awal berdasarkan gejala yang dilaporkan, tanpa menggantikan peran dokter mata dalam pemeriksaan fisik atau tindakan medis lebih lanjut.
                </p>
                <p class="section-content">
                    Dengan demikian, ruang lingkup penelitian ini diharapkan dapat menghasilkan sistem pakar yang bermanfaat dalam membantu masyarakat dan tenaga medis dalam mendiagnosa penyakit mata secara lebih efektif dan efisien.
                </p>
            </section>
        </main>
    </div>
</body>
</html>
