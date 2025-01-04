<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php?page=home">Home</a></li>
                    <li class="breadcrumb-item active">Dokter</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Dokter</h3>
                        <div class="card-tools">
                            <!-- Admin bisa menambah dokter -->
                            <?php if ($_SESSION['akses'] == 'admin') { ?>
                                <button type="button" class="btn btn-sm btn-success float-right" data-toggle="modal" data-target="#addModal">Tambah</button>
                            <?php } ?>
                            <!-- Modal Tambah Data Dokter -->
                            <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addModalLabel">Tambah Data Dokter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="pages/dokter/tambahDokter.php" method="post">
                                                <div class="form-group">
                                                    <label for="nama_dokter">Nama Dokter</label>
                                                    <input type="text" class="form-control" id="nama_dokter" name="nama" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password</label>
                                                    <input type="password" class="form-control" id="password" name="password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alamat">Alamat</label>
                                                    <textarea class="form-control" rows="3" placeholder="Masukkan alamat" id="alamat" name="alamat"></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="no_hp">Nomor HP</label>
                                                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="poli">Poli</label>
                                                    <select class="form-control" id="poli" name="poli">
                                                        <?php
                                                        require 'config/koneksi.php';
                                                        $query = "SELECT * FROM poli";
                                                        $result = mysqli_query($mysqli, $query);
                                                        while ($dataPoli = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <option value="<?php echo $dataPoli['id'] ?>"><?php echo $dataPoli['nama_poli'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Data Dokter -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokter</th>
                                    <th>Password</th>
                                    <th>Alamat</th>
                                    <th>No HP</th>
                                    <th>Poli</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require 'config/koneksi.php';
                                $no = 1;

                                // Admin dapat melihat semua data dokter
                                if ($_SESSION['akses'] == 'admin') {
                                    $query = "
                                        SELECT dokter.id, dokter.nama, dokter.password, dokter.alamat, dokter.no_hp, poli.nama_poli
                                        FROM dokter
                                        INNER JOIN poli ON dokter.id_poli = poli.id";
                                }
                                // Dokter hanya bisa melihat data dirinya sendiri
                                else if ($_SESSION['akses'] == 'dokter') {
                                    $idDokter = $_SESSION['id'];
                                    $query = "
                                        SELECT dokter.id, dokter.nama, dokter.password, dokter.alamat, dokter.no_hp, poli.nama_poli
                                        FROM dokter
                                        INNER JOIN poli ON dokter.id_poli = poli.id
                                        WHERE dokter.id = $idDokter";
                                }

                                $result = mysqli_query($mysqli, $query);

                                while ($data = mysqli_fetch_assoc($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $data['nama'] ?></td>
                                        <td><?php echo $data['password'] ?></td>
                                        <td style="white-space: pre-line;"><?php echo $data['alamat'] ?></td>
                                        <td><?php echo $data['no_hp'] ?></td>
                                        <td><?php echo $data['nama_poli'] ?></td>
                                        <td>
                                            <!-- Admin bisa melakukan aksi update dan hapus ke semua dokter -->
                                            <?php if ($_SESSION['akses'] == 'admin') { ?>
                                                <button type="button" class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editModal<?php echo $data['id'] ?>">Edit</button>
                                                <button type="button" class="btn btn-sm btn-danger edit-btn" data-toggle="modal" data-target="#hapusModal<?php echo $data['id'] ?>">Hapus</button>
                                            <?php } ?>
                                            
                                            <!-- Dokter hanya bisa mengedit atau menghapus data dirinya sendiri -->
                                            <?php if ($_SESSION['akses'] == 'dokter' && $_SESSION['id'] == $data['id']) { ?>
                                                <button type="button" class="btn btn-sm btn-warning edit-btn" data-toggle="modal" data-target="#editModal<?php echo $data['id'] ?>">Edit</button>
                                            <?php } ?>
                                        </td>
                                    </tr>

                                    <!-- Modal Edit Data Dokter -->
                                    <div class="modal fade" id="editModal<?php echo $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Data Dokter</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="pages/dokter/updateDokter.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>" required>
                                                        <div class="form-group">
                                                            <label for="nama">Nama Dokter</label>
                                                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $data['password'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea class="form-control" rows="3" id="alamat" name="alamat"><?php echo $data['alamat'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_hp">No HP</label>
                                                            <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?php echo $data['no_hp'] ?>" required>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-success">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus Data Dokter -->
                                    <div class="modal fade" id="hapusModal<?php echo $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="hapusModalLabel">Hapus Data Dokter</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="pages/dokter/hapusDokter.php" method="post">
                                                        <input type="hidden" name="id" value="<?php echo $data['id'] ?>" required>
                                                        <p>Apakah Anda yakin ingin menghapus data dokter <strong><?php echo $data['nama'] ?></strong>?</p>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
