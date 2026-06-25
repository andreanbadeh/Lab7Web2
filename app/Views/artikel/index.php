<?= $this->include('template/header'); ?>

<h1><?= $title; ?></h1>

<?php if ($artikel): foreach ($artikel as $row): ?>
<article class="entry">

    <h2>
        <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
            <?= $row['judul']; ?>
        </a>
    </h2>

    <!-- ✅ Tambahan kategori -->
    <p><strong>Kategori:</strong> <?= $row['nama_kategori']; ?></p>

    <img src="<?= base_url('/gambar/' . $row['gambar']); ?>" 
         alt="<?= $row['judul']; ?>" 
         width="300">

    <p><?= substr($row['isi'], 0, 200); ?>...</p>

</article>

<hr class="divider" />

<?php endforeach; else: ?>

<article class="entry">
    <h2>Belum ada data.</h2>
</article>

<?php endif; ?>

<?= $this->include('template/footer'); ?>