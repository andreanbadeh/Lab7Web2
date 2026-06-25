<?= $this->include('template/header'); ?>

<h1><?= $title; ?></h1>

<?php if($artikel): foreach($artikel as $row): ?>
    <article>
        <h2>
            <a href="<?= base_url('/artikel/' . $row['slug']); ?>">
                <?= $row['judul']; ?>
            </a>
        </h2>
        <p><?= $row['isi']; ?></p>
    </article>
<?php endforeach; else: ?>
    <p>Tidak ada data.</p>
<?php endif; ?>

<?= $this->include('template/footer'); ?>