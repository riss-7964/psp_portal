<?php include '../views/layouts/header.php'; ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Sistem Pengurusan Markah Pelajar</h2>
    <a href="index.php?action=create_student" class="btn btn-success">+ Tambah Pelajar</a>
</div>
<div class="card shadow-sm">
    <div class="card-body">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. IC</th>
                    <th>Program</th>
                    <th>Markah</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['ic']); ?></td>
                    <td><?php echo htmlspecialchars($row['program']); ?></td>
                    <td><span class="badge bg-primary fs-6"><?php echo $row['marks']; ?></span></td>
                    <td>
                        <a href="index.php?action=edit_student&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="index.php?action=delete_student&id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Adakah anda pasti untuk memadam rekod ini secara kekal?');">Padam</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php include '../views/layouts/footer.php'; ?>