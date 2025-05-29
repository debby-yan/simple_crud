<?php
include('./template/head.php');
include('./config/database_conection.php');

// Ambil semua data user
function getAllUser($db) {
    $sql = "SELECT * FROM users";
    return $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

$users = getAllUser($db);
?>

<style>
    body {
        background-color: #ffe6f0;
    }
    .table thead {
        background-color: #ffb6c1;
        color: white;
    }
    .btn-success {
        background-color: #ff69b4;
        border-color: #ff69b4;
    }
    .btn-danger {
        background-color: #ff1493;
        border-color: #ff1493;
    }
    .card-custom {
        border: 2px solid #ffc0cb;
        box-shadow: 0 0 15px rgba(255, 192, 203, 0.4);
        background-color: white;
    }
</style>

<div class="container py-5">
    <div class="card card-custom">
        <div class="card-header text-white" style="background-color: #ff69b4;">
        </div>
        <div class="card-body">
            <h4 class="mb-3">Daftar Pengguna</h4>
            <div class="table-responsive">
                <table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)) : ?>
                            <?php foreach ($users as $user) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id']) ?></td>
                                    <td><?= htmlspecialchars($user['name']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td><?= htmlspecialchars($user['password']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5">Tidak ada data pengguna</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
    </div>
</div>

<?php include('./template/foot.php'); ?>


<script>
    // Cetak otomatis
    window.print();
</script>

</body>
</html>
