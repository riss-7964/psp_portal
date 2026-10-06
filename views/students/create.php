<?php include '../views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h3>Tambah Rekod Pelajar</h3>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="index.php?action=create_student" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Pelajar</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. IC</label>
                        <input type="text" name="ic" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program</label>
                        <input type="text" name="program" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Markah</label>
                        <input type="number" step="0.01" name="marks" class="form-control" min="0" max="100" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../views/layouts/footer.php'; ?>