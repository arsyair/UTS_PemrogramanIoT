<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Data Dashboard</title>
    <!-- Mengimpor Bootstrap CSS untuk styling -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container my-5">
    <h1 class="text-center mb-4">Weather Data Dashboard</h1>

    <?php
    // URL dari API data cuaca
    $url = 'http://localhost/utsiot/get.php';
    $json_data = file_get_contents($url);
    $data = json_decode($json_data, true);

    if ($data) {
        echo '
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Suhu Maksimum</h5>
                        <p class="card-text">' . htmlspecialchars($data['suhu_max']) . ' °C</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Kelembapan Maksimum</h5>
                        <p class="card-text">' . htmlspecialchars($data['humid_max']) . ' %</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-light mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Rata-rata Suhu</h5>
                        <p class="card-text">' . htmlspecialchars($data['suhurata']) . ' °C</p>
                    </div>
                </div>
            </div>
        </div>';

        echo '<h3 class="mt-5">Data Suhu dan Kelembapan Maksimum</h3>';
        echo '<table class="table table-bordered table-striped mt-3">';
        echo '<thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Suhu</th>
                    <th>Kelembapan</th>
                    <th>Kecerahan</th>
                    <th>Timestamp</th>
                </tr>
              </thead>';
        echo '<tbody>';
        foreach ($data['nilai_suhu_max_humid_max'] as $entry) {
            echo '<tr>
                    <td>' . htmlspecialchars($entry['idx']) . '</td>
                    <td>' . htmlspecialchars($entry['suhux']) . ' °C</td>
                    <td>' . htmlspecialchars($entry['humid']) . ' %</td>
                    <td>' . htmlspecialchars($entry['kecerahan']) . ' lux</td>
                    <td>' . htmlspecialchars($entry['timestamp']) . '</td>
                  </tr>';
        }
        echo '</tbody></table>';

        echo '<h3 class="mt-5">Bulan-Tahun dengan Suhu dan Kelembapan Maksimum</h3>';
        echo '<ul class="list-group mt-3">';
        foreach ($data['month_year_max'] as $monthYear) {
            echo '<li class="list-group-item">' . htmlspecialchars($monthYear['month_year']) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<p class="text-danger">Gagal mengambil data cuaca. Silakan coba lagi.</p>';
    }
    ?>

</div>

<!-- Mengimpor Bootstrap JS untuk interaktivitas -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
