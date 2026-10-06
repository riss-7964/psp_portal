<?php include '../views/layouts/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h3>Kemaskini Rekod Pelajar</h3>
            </div>
            <div class="card-body">
                <form action="index.php?action=edit_student&id=<?php echo $student['id']; ?>" method="POST">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Pelajar</label>
                        <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($student['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. IC</label>
                        <input type="text" name="ic" class="form-control" value="<?php echo htmlspecialchars($student['ic']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Program</label>
                        <input type="text" name="program" class="form-control" value="<?php echo htmlspecialchars($student['program']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Markah</label>
                        <input type="number" step="0.01" name="marks" class="form-control" value="<?php echo htmlspecialchars($student['marks']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kemaskini</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../views/layouts/footer.php'; ?>