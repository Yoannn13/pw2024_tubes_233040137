<?php
require 'inc/koneksi.php';

$search = isset($_POST['query']) ? $_POST['query'] : '';

$query = "SELECT * FROM team WHERE nama LIKE '%$search%' OR kotaAsal LIKE '%$search%' OR negara LIKE '%$search%'";
$result = mysqli_query($conn, $query);

if ($result === false) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

while ($data = mysqli_fetch_array($result)) : ?>
    <div class="col-md-4">
        <div class="card mb-4">
            <img src="css/image/<?php echo htmlspecialchars($data['gambar']); ?>" class="card-img-top custom-image-size" alt="<?php echo htmlspecialchars($data['nama']); ?>">
            <div class="card-body custom-card-size">
                <h5 class="card-title"><?php echo htmlspecialchars($data['nama']); ?></h5>
                <p class="card-title">Kota Asal: <?php echo htmlspecialchars($data['kotaAsal']); ?></p>
                <p class="card-title">Negara: <?php echo htmlspecialchars($data['negara']); ?></p>
                <p class="card-title">Stadion: <?php echo htmlspecialchars($data['stadion']); ?></p>
                <p class="card-title">Tahun Didirikan: <?php echo htmlspecialchars($data['tahunDidirikan']); ?></p>
                <p class="card-title">Pelatih: <?php echo htmlspecialchars($data['pelatih']); ?></p>
            </div>
        </div>
    </div>
<?php endwhile; ?>

