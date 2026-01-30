<?php
session_start();
require_once '../config/database.php';
require_once '../config/functions.php';

check_role(['admin']);

$page_title = 'Manajemen User';

// Get all users with their login info
$query = "SELECT user.*, login.username FROM user 
          LEFT JOIN login ON login.id_user = user.id_user 
          ORDER BY user.id_user DESC";
$users = mysqli_query($conn, $query);

// Get penduduk list for dropdown
$penduduk_list = mysqli_query($conn, "SELECT * FROM penduduk ORDER BY nama_lengkap");

include '../views/layout_header.php';
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Manajemen User</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php if ($success = get_flash('success')): ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $success ?>
            </div>
        <?php endif; ?>

        <?php if ($error = get_flash('error')): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?= $error ?>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Daftar User</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modalAddUser">
                        <i class="fas fa-plus"></i> Tambah User
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        while ($user = mysqli_fetch_assoc($users)): ?>
                            <tr>
                                <td>
                                    <?= $no++ ?>
                                </td>
                                <td>
                                    <?= $user['username'] ?>
                                </td>
                                <td>
                                    <?= $user['nama_lengkap'] ?>
                                </td>
                                <td>
                                    <?= $user['email'] ?>
                                </td>
                                <td><span class="badge badge-info">
                                        <?= ucfirst($user['role']) ?>
                                    </span></td>
                                <td>
                                    <a href="user_delete.php?id=<?= $user['id_user'] ?>" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal Add User -->
<div class="modal fade" id="modalAddUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="user_save.php" method="POST">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah User</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" id="roleSelect" class="form-control" required>
                            <option value="">-- Pilih Role --</option>
                            <option value="admin">Admin</option>
                            <option value="jagabaya">Jagabaya</option>
                            <option value="ulu-ulu">Ulu-ulu</option>
                            <option value="lurah">Lurah</option>
                            <option value="penduduk">Penduduk</option>
                        </select>
                    </div>
                    <div class="form-group" id="pendudukGroup" style="display:none;">
                        <label>Pilih Data Penduduk (Wajib untuk Role Penduduk)</label>
                        <select name="id_penduduk" class="form-control">
                            <option value="">-- Pilih Penduduk --</option>
                            <?php mysqli_data_seek($penduduk_list, 0);
                            while ($p = mysqli_fetch_assoc($penduduk_list)): ?>
                                <option value="<?= $p['id_penduduk'] ?>">
                                    <?= $p['nik'] ?> -
                                    <?= $p['nama_lengkap'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#roleSelect').change(function () {
        if ($(this).val() == 'penduduk') {
            $('#pendudukGroup').show();
        } else {
            $('#pendudukGroup').hide();
        }
    });
</script>

<?php include '../views/layout_footer.php'; ?>