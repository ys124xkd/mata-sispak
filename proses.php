<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mendapatkan gejala yang dipilih oleh pengguna
    $selected_gejala = isset($_POST['gejala']) ? $_POST['gejala'] : [];

    if (count($selected_gejala) > 0) {
        // Ambil semua aturan dari database
        $query = $conn->query("SELECT * FROM aturan");
        $penyakit_ditemukan = [];

        // Proses pencocokan aturan (forward chaining)
        while ($row = $query->fetch_assoc()) {
            $kode_gejala_rule = explode(',', $row['kode_gejala']); // Gejala dari aturan
            $kode_penyakit = $row['kode_penyakit'];

            // Menghitung gejala yang cocok
            $matched_gejala = array_intersect($kode_gejala_rule, $selected_gejala);
            $persentase = (count($matched_gejala) / count($kode_gejala_rule)) * 100;

            if ($persentase > 0) {
                $penyakit_ditemukan[] = [
                    'kode_penyakit' => $kode_penyakit,
                    'persentase' => $persentase
                ];
            }
        }

        // Jika ada penyakit yang ditemukan, tampilkan hasilnya
        if (count($penyakit_ditemukan) > 0) {
            echo "<h2>Hasil Diagnosa</h2>";
            foreach ($penyakit_ditemukan as $penyakit) {
                // Ambil keterangan penyakit dari database
                $query_penyakit = $conn->prepare("SELECT nama_penyakit FROM penyakit WHERE kode_penyakit = ?");
                $query_penyakit->bind_param("s", $penyakit['kode_penyakit']);
                $query_penyakit->execute();
                $result_penyakit = $query_penyakit->get_result();
                $penyakit_info = $result_penyakit->fetch_assoc();

                echo "<p><strong>" . $penyakit_info['nama_penyakit'] . "</strong> kemungkinan sebesar " . round($penyakit['persentase'], 2) . "%</p>";
            }
        } else {
            echo "<h2>Tidak ditemukan penyakit berdasarkan gejala yang dipilih.</h2>";
        }
    } else {
        echo "<h2>Anda belum memilih gejala apapun.</h2>";
    }
}
?>

<br>
<a href="user/diagnosa.php">Kembali ke Halaman Diagnosa</a>
