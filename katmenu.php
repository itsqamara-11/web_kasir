<?php
include "proses/connect.php";
$query = mysqli_query($conn, "SELECT * FROM tb_kategori_menu");
$result = []; // Inisialisasi array $result
while ($record = mysqli_fetch_array($query)) {
  $result[] = $record;
}
?>

<div class="col-lg-9 mt-2">
  <div class="card">
    <div class="card-header">
      Halaman Kategori Menu
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col d-flex justify-content-end">
          <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalTambahUser">Tambah Kategori Menu</button>
        </div>
      </div>
      <!-- Modal tambah kategori menu baru-->
      <div class="modal fade" id="ModalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-md-down">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori Menu</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="needs-validation" novalidate action="proses/proses_input_katmenu.php" method="POST">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <select class="form-select" name="jenismenu" id="jenisMenu" required>
                        <option value="" disabled selected>Pilih Jenis Menu</option>
                        <option value="1">Makanan</option>
                        <option value="2">Minuman</option>
                      </select>
                      <label for="jenisMenu">Jenis Menu</label>
                      <div class="invalid-feedback">
                        Masukkan Jenis Menu.
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="kategoriMenu" placeholder="Nama Kategori Menu" name="katmenu" required>
                      <label for="kategoriMenu">Kategori Menu</label>
                      <div class="invalid-feedback">
                        Masukkan Kategori Menu.
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="input_katmenu_validate" value="12345">Save changes</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Akhir Modal tambah kategori menu baru-->


      <?php foreach ($result as $row): ?>
        <!-- Modal Edit-->
        <div class="modal fade" id="ModalEdit<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_edit_katmenu.php" method="POST">
                  <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id_kat_menu">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <select class="form-select" aria-label="Jenis Menu" required name="jenismenu" id="jenisMenu">
                          <?php
                          $data = array("Makanan", "Minuman");
                          foreach ($data as $key => $value) {
                            // Ensure values match the ones stored in the database
                            $selected = ($row['jenis_menu'] == $key + 1) ? 'selected' : '';
                            echo "<option value='" . ($key + 1) . "' $selected>$value</option>";
                          }
                          ?>
                        </select>
                        <label for="jenisMenu">Jenis Menu</label>
                        <div class="invalid-feedback">
                          Pilih Jenis Menu.
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="editKategoriMenu" placeholder="Nama Kategori Menu" name="katmenu" required value="<?php echo htmlspecialchars($row['kategori_menu'], ENT_QUOTES, 'UTF-8'); ?>">
                        <label for="editKategoriMenu">Kategori Menu</label>
                        <div class="invalid-feedback">
                          Masukkan Kategori Menu.
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="edit_katmenu_validate" value="12345">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Edit-->


        <!-- Modal Delete-->
        <div class="modal fade" id="ModalDelete<?php echo $row['id_kat_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md modal-fullscreen-md-down">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data Kategori Menu</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="needs-validation" novalidate action="proses/proses_delete_katmenu.php" method="POST">
                  <input type="hidden" value="<?php echo $row['id_kat_menu'] ?>" name="id">
                  <div class="col-lg-12">
                    Apakah anda ingin menghapus kategori <b><?php echo $row['kategori_menu'] ?> </b>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger" name="hapus_kategori_validate" value="12345">Hapus</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Akhir Modal Delete-->
      <?php endforeach; ?>

      <?php if (empty($result)): ?>
        <p>Data kategori menu tidak ada</p>
      <?php else: ?>
        <!-- Tabel Daftar Kategori Menu -->
        <div class="table-responsive">
          <table class="table table-hover" id="example">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Jenis Menu</th>
                <th scope="col">Kategori Menu</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach ($result as $row): ?>
                <tr>
                  <th scope="row"><?php echo $no++ ?></th>
                  <td>
                    <?php echo ($row['jenis_menu'] == 1) ? "Makanan" : "Minuman"; ?>
                  </td>
                  <td>
                    <?php echo $row['kategori_menu']; ?>
                  </td>
                  <td class="d-flex">
                    <button class="btn btn-outline-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalEdit<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-pencil-square"></i></button>
                    <button class="btn btn-outline-danger btn-sm me-1" data-bs-toggle="modal" data-bs-target="#ModalDelete<?php echo $row['id_kat_menu']; ?>"><i class="bi bi-trash3"></i></button>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- Akhir Tabel Daftar Kategori Menu -->
      <?php endif; ?>
    </div>
  </div>
</div>