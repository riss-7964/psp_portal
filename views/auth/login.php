<?php include '../views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white text-center">
                <h4>Log Masuk Pelajar</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="index.php?action=login" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <div class="mb-3">
                        <label class="form-label">No. IC</label>
                        <input type="text" name="ic" class="form-control" required placeholder="Contoh: 020101071234">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kata Laluan</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Log Masuk</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../views/layouts/footer.php'; ?>