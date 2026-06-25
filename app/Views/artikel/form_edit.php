<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<form action="<?= base_url('/admin/artikel/edit/' . $artikel['id']); ?>" method="post">

    <p>
        <label for="judul">Judul</label><br>
        <input type="text" name="judul" id="judul" 
               value="<?= $artikel['judul']; ?>" required>
    </p>

    <p>
        <label for="isi">Isi</label><br>
        <textarea name="isi" id="isi" cols="50" rows="10"><?= $artikel['isi']; ?></textarea>
    </p>

    <!-- ✅ Dropdown kategori (auto selected) -->
    <p>
        <label for="id_kategori">Kategori</label><br>
        <select name="id_kategori" id="id_kategori" required>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>" 
                    <?= ($artikel['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= $k['nama_kategori']; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>

    <p>
        <input type="submit" value="Update" class="btn btn-large">
    </p>

</form>

<?= $this->include('template/admin_footer'); ?>