<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<!-- ⚠️ WAJIB tambahkan enctype -->
<form action="" method="post" enctype="multipart/form-data">

    <p>
        <label for="judul">Judul</label><br>
        <input type="text" name="judul" id="judul" required>
    </p>

    <p>
        <label for="isi">Isi</label><br>
        <textarea name="isi" id="isi" cols="50" rows="10"></textarea>
    </p>

    <!-- ✅ Kategori -->
    <p>
        <label for="id_kategori">Kategori</label><br>
        <select name="id_kategori" id="id_kategori" required>
            <option value="">-- Pilih Kategori --</option>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>">
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <!-- ✅ TAMBAHAN INPUT FILE -->
    <p>
        <label for="gambar">Gambar</label><br>
        <input type="file" name="gambar" id="gambar">
    </p>

    <p>
        <button type="submit">Simpan</button>
    </p>

</form>

<?= $this->include('template/admin_footer'); ?>