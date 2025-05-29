<?php
include('./template/head.php');
include('./config/database_conection.php');

$errors = [];
$name = '';
$password = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $password = $_POST['password'];

    // Validasi input
    if ($name === "") $errors['name'] = "Nama tidak boleh kosong";
    if ($password === "") $errors['password'] = "Password tidak boleh kosong";

    if (!$errors) {
        // Hash password
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // Simpan data ke database
        $sql = "INSERT INTO users (name, password) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $saved = $stmt->execute([$name, $hashPassword]);

        if ($saved) {
            echo "<script>alert('Data berhasil disimpan'); window.location.href='user_show.php';</script>";
            exit;
        } else {
            echo "<div class='alert alert-danger'>Gagal menyimpan data.</div>";
        }
    }
}
?>

<!-- 🌸 Tema Pink Custom CSS -->
<style>
    body {
        background-color: #ffe6f0;
    }
    .card-header {
        background-color: #ff69b4 !important;
    }
    .btn-success {
        background-color: #ff69b4;
        border-color: #ff69b4;
    }
    .btn-secondary {
        background-color: #ffc0cb;
        border-color: #ffc0cb;
        color: #333;
    }
    .btn-success:hover,
    .btn-secondary:hover {
        opacity: 0.9;
    }
    .form-control:focus {
        border-color: #ff69b4;
        box-shadow: 0 0 0 0.2rem rgba(255, 105, 180, 0.25);
    }
</style>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header text-white">
                    <h4 class="mb-0">Register</h4>
                </div>
                <div class="card-body">

                    <form method="POST">
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input name="name" type="text" class="form-control <?= isset($errors['name']) ? 'is-invalid' : '' ?>" id="name" value="<?= htmlspecialchars($name) ?>">
                            <?php if (isset($errors['name'])): ?>
                                <div class="invalid-feedback"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input name="password" type="password" class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password">
                            <?php if (isset($errors['password'])): ?>
                                <div class="invalid-feedback"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include('./template/foot.php'); ?>
