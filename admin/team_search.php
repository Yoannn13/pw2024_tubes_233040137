<?php
require '../inc/koneksi.php';

$search = isset($_POST['query']) ? $_POST['query'] : '';

$query = "SELECT team.*, kategori.nama AS nama_kategori FROM team 
          JOIN kategori ON team.kategori_id = kategori.id 
          WHERE team.nama LIKE '%$search%' OR kotaAsal LIKE '%$search%' OR negara LIKE '%$search%' 
          ORDER BY team.kategori_id DESC";
$result = mysqli_query($conn, $query);

if ($result === false) {
    echo "Error: " . mysqli_error($conn);
    exit;
}

while ($data = mysqli_fetch_assoc($result)) : ?>
    <tr>
        <td><?php echo htmlspecialchars($data['id']); ?></td>
        <td><?php echo htmlspecialchars($data['nama']); ?></td>
        <td><?php echo htmlspecialchars($data['nama_kategori']); ?></td>
        <td><?php echo htmlspecialchars($data['kotaAsal']); ?></td>
        <td><?php echo htmlspecialchars($data['negara']); ?></td>
        <td><?php echo htmlspecialchars($data['stadion']); ?></td>
        <td><?php echo htmlspecialchars($data['tahunDidirikan']); ?></td>
        <td><?php echo htmlspecialchars($data['pelatih']); ?></td>
        <td><img src="../css/image/<?php echo htmlspecialchars($data['gambar']); ?>" alt="" width="120"></td>
        <td><a href="team-detail.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-info"><i class="fas fa-search"></i></a></td>
    </tr>
<?php endwhile; ?>
