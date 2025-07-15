<?php
// Pastikan direktori data ada
$dataDir = 'data';
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0777, true);
}

// Path ke file data.json
$dataFile = $dataDir . '/data.json';

// Buat file data.json jika belum ada
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

// Baca data dengan penanganan error
try {
    $jsonData = file_get_contents($dataFile);
    if ($jsonData === false) {
        throw new Exception("Tidak dapat membaca file data.json");
    }
    $data = json_decode($jsonData, true);
    if ($data === null) {
        $data = [];
    }
} catch (Exception $e) {
    $data = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CRUD Application with PHP Native">
    <meta name="theme-color" content="#212529">
    <title>CRUD PHP Native</title>
    
    <!-- Bootstrap 5.3.1 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            min-height: 100vh;
        }
        
        .navbar {
            padding: 1rem 0;
            background-color: #1a1a1a !important;
        }
        
        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
        }

        .nav-link {
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: #fff;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }
        
        .table-container {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #0d6efd;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60%;
            height: 3px;
            background: #0d6efd;
            border-radius: 2px;
        }
        
        .table img {
            transition: transform 0.3s ease;
            max-width: 150px;
            height: auto;
        }
        
        .table img:hover {
            transform: scale(1.1);
        }
        
        .btn-action {
            transition: all 0.3s ease;
            width: 40px;
            height: 40px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        
        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .empty-state {
            padding: 3rem;
            text-align: center;
            color: #6c757d;
        }
        
        .empty-state i {
            font-size: 4rem;
            margin-bottom: 1rem;
            color: #dee2e6;
        }

        .empty-state p {
            font-size: 1.2rem;
            margin-bottom: 0;
        }

        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <!-- Navbar dengan Bootstrap -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <!-- Brand logo and name -->
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <i class="fas fa-database me-2"></i>
                CRUD Application
            </a>

            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">
                            <i class="fas fa-home me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">
                            <i class="fas fa-plus me-1"></i> Tambah Data
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php if (isset($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?php echo $error; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <h1 class="page-title text-center">Daftar Data</h1>
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover align-middle table-striped mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="5%">ID</th>
                            <th width="20%">Nama</th>
                            <th width="20%">Email</th>
                            <th width="15%">Tanggal Lahir</th>
                            <th width="20%">Alamat</th>
                            <th width="10%">Gambar</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (is_array($data) && count($data) > 0): ?>
                            <?php foreach ($data as $index => $item): ?>
                            <tr>
                                <td class="text-center"><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($item['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($item['email'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($item['dob'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($item['address'] ?? ''); ?></td>
                                <td class="text-center">
                                    <?php if (!empty($item['image'])): ?>
                                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Gambar"
                                        class="img-fluid rounded shadow-sm">
                                    <?php else: ?>
                                    <i class="fas fa-image text-muted" style="font-size: 2rem;"></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="edit.php?id=<?php echo $index; ?>"
                                            class="btn btn-outline-primary btn-sm btn-action"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete.php?id=<?php echo $index; ?>"
                                            class="btn btn-outline-danger btn-sm btn-action"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                            title="Hapus">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="empty-state">
                                    <i class="fas fa-database"></i>
                                    <p>Tidak ada data yang tersedia.</p>
                                    <a href="create.php" class="btn btn-primary mt-3">
                                        <i class="fas fa-plus me-1"></i> Tambah Data Baru
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>