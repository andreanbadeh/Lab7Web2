<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('/style.css'); ?>">
</head>

<body>

<div id="container">

    <header>
        <h1>Layout Sederhana</h1>
        <p>
            Modul Praktikum Pemrograman Web 2<br>
            Aflah Athallah Tamam Kapukong (tamam@pelitabangsa.ac.id)<br>
            Universitas Pelita Bangsa, Bekasi
        </p>
    </header>

    <nav>
        <a href="<?= base_url('/'); ?>" class="active">Home</a>
        <a href="<?= base_url('/artikel'); ?>">Artikel</a>
        <a href="<?= base_url('/about'); ?>">About</a>
        <a href="<?= base_url('/contact'); ?>">Kontak</a>
    </nav>

    <section id="wrapper">
        <section id="main">