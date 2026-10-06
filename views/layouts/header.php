<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSP Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php?action=profile">PSP Portal</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <?php if (isset($_SESSION['user_id'])): ?>
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php?action=profile">Profil Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=change_password">Tukar Password</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=students">Pengurusan Markah</a></li>
      </ul>
      <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Log Keluar</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container">