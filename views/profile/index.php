<?php include '../views/layouts/header.php'; ?>


<div class="row justify-content-center">

    <div class="col-md-7">

        <div class="card shadow-sm">

            <!-- HEADER -->
            <div class="card-header bg-info text-white">

                <h3 class="mb-0">
                    Profil Pelajar
                </h3>

            </div>


            <div class="card-body">


                <!-- ================================= -->
                <!-- MESSAGE -->
                <!-- ================================= -->

                <?php if (!empty($message)): ?>

                    <div class="alert alert-<?php echo htmlspecialchars($messageType); ?>">

                        <?php
                        echo htmlspecialchars($message);
                        ?>

                    </div>

                <?php endif; ?>


                <!-- ================================= -->
                <!-- PROFILE PICTURE -->
                <!-- ================================= -->

                <div class="text-center mb-4">


                    <?php if (
                        !empty(
                            $student['profile_picture']
                        )
                    ): ?>

                        <img
                            src="../uploads/<?php
                                echo htmlspecialchars(
                                    $student['profile_picture']
                                );
                            ?>"
                            alt="Profile Picture"
                            width="160"
                            height="160"
                            class="rounded-circle border"
                            style="object-fit: cover;"
                        >

                    <?php else: ?>

                        <div
                            class="rounded-circle bg-light border d-flex align-items-center justify-content-center mx-auto"
                            style="
                                width:160px;
                                height:160px;
                            "
                        >

                            <span class="text-muted">
                                No Picture
                            </span>

                        </div>

                    <?php endif; ?>


                </div>


                <!-- ================================= -->
                <!-- UPLOAD FORM -->
                <!-- ================================= -->

                <form
                    method="POST"
                    enctype="multipart/form-data"
                    class="mb-4"
                >


                    <div class="mb-3">

                        <label
                            for="profile_picture"
                            class="form-label"
                        >
                            <strong>
                                Profile Picture
                            </strong>
                        </label>


                        <input
                            type="file"
                            name="profile_picture"
                            id="profile_picture"
                            class="form-control"
                            accept=".jpg,.jpeg,.png"
                            required
                        >


                        <small class="text-muted">

                            Allowed:
                            JPG, JPEG, PNG

                            <br>

                            Maximum file size:
                            2MB

                        </small>

                    </div>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        Upload Picture

                    </button>


                </form>


                <!-- ================================= -->
                <!-- STUDENT INFORMATION -->
                <!-- ================================= -->

                <table class="table table-bordered">

                    <tr>

                        <th>
                            Nama
                        </th>

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $student['name']
                                ?? 'N/A'
                            );
                            ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            No. Kad Pengenalan (NRIC)
                        </th>

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $student['ic']
                                ?? 'N/A'
                            );
                            ?>

                        </td>

                    </tr>


                    <tr>

                        <th>
                            Program
                        </th>

                        <td>

                            <?php
                            echo htmlspecialchars(
                                $student['program']
                                ?? 'N/A'
                            );
                            ?>

                        </td>

                    </tr>


                </table>


            </div>

        </div>

    </div>

</div>


<?php include '../views/layouts/footer.php'; ?>