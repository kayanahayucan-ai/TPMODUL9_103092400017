<?php
// Mengecek apakah halaman diakses melalui submit form POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengamankan input teks dari karakter HTML berbahaya
    $nama = htmlspecialchars($_POST['nama']);
    $tgl_input = $_POST['tgl_lahir'];

    // Daftar nama bulan dalam bahasa Indonesia
    $bulan_indo = [
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    ];

    // Memecah format YYYY-MM-DD menjadi bagian terpisah
    $pecah_tgl = explode('-', $tgl_input);
    $tahun = $pecah_tgl[0];
    $bulan = $bulan_indo[$pecah_tgl[1]];
    $tanggal = (int)$pecah_tgl[2]; // Casting ke int agar '07' menjadi '7'

    $tgl_lahir_formatted = $tanggal . ' ' . $bulan . ' ' . $tahun;

    // Mengolah checkbox Hobi
    if (isset($_POST['hobi']) && !empty($_POST['hobi'])) {
        $hobi_formatted = implode(', ', $_POST['hobi']);
    } else {
        $hobi_formatted = "Tidak ada hobi yang dipilih";
    }
} else {
    // Jika diakses langsung tanpa submit form, arahkan kembali ke form
    header("Location: form_data_diri.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampilan Data Anda</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 30px;
            color: #111;
        }
        .container {
            max-width: 550px;
        }
        h2 {
            font-size: 26px;
            padding-bottom: 14px;
            border-bottom: 1px solid #e0e0e0;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            margin-bottom: 24px;
        }
        td {
            padding: 8px 0;
            vertical-align: top;
            font-size: 15px;
        }
        td.label {
            font-weight: bold;
            width: 120px;
            padding-right: 15px;
        }
        a.back-link {
            color: #1a73e8;
            text-decoration: none;
            font-size: 14px;
        }
        a.back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tampilan Data Anda</h2>

    <table>
        <tr>
            <td class="label">Nama Lengkap:</td>
            <td><?php echo $nama; ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Lahir:</td>
            <td><?php echo $tgl_lahir_formatted; ?></td>
        </tr>
        <tr>
            <td class="label">Hobi:</td>
            <td><?php echo htmlspecialchars($hobi_formatted); ?></td>
        </tr>
    </table>

    <a href="form_data_diri.html" class="back-link">&laquo; Kembali ke Form</a>
</div>

</body>
</html>