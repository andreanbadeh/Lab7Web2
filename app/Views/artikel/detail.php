<?= $this->include('template/header'); ?>

<h1><?= $artikel['judul']; ?></h1>

<img src="<?= base_url('/gambar/' . $artikel['gambar']); ?>" alt="<?= $artikel['judul']; ?>" width="400">

<p><?= $artikel['isi']; ?></p>

<br>
<a href="<?= base_url('/artikel'); ?>">← Kembali ke daftar artikel</a>

<?= $this->include('template/footer'); ?>