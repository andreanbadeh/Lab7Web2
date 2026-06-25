<?= $this->include('template/admin_header'); ?>

<h2><?= $title; ?></h2>

<!-- Tombol -->
<a href="<?= base_url('/user/logout'); ?>">
    Logout
</a>

<br><br>

<a href="<?= base_url('/admin/artikel/add'); ?>">
    + Tambah Artikel
</a>

<br><br>

<!-- FORM SEARCH + FILTER -->
<form id="search-form" class="form-inline">

    <input
        type="text"
        name="q"
        id="search-box"
        value="<?= $q; ?>"
        placeholder="Cari judul artikel"
        class="form-control mr-2"
    >

    <select
        name="kategori_id"
        id="category-filter"
        class="form-control mr-2"
    >

        <option value="">Semua Kategori</option>

        <?php foreach ($kategori as $k): ?>

            <option
                value="<?= $k['id_kategori']; ?>"
                <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>
            >
                <?= $k['nama_kategori']; ?>
            </option>

        <?php endforeach; ?>

    </select>

    <input
        type="submit"
        value="Cari"
        class="btn btn-primary"
    >

</form>

<br>

<!-- Container Artikel -->
<div id="article-container"></div>

<!-- Container Pagination -->
<div id="pagination-container"></div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function () {

    const articleContainer = $('#article-container');

    const paginationContainer = $('#pagination-container');

    const searchForm = $('#search-form');

    const searchBox = $('#search-box');

    const categoryFilter = $('#category-filter');

    // Function AJAX
    const fetchData = (url) => {

        $.ajax({

            url: url,

            type: 'GET',

            dataType: 'json',

            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            success: function (data) {

                renderArticles(data.artikel);

                renderPagination(
                    data.pager,
                    data.q,
                    data.kategori_id
                );
            }
        });
    };

    // Render artikel
    const renderArticles = (articles) => {

        let html = `
            <table border="1" cellpadding="10">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
        `;

        if (articles.length > 0) {

            articles.forEach(article => {

                html += `
                    <tr>

                        <td>${article.id}</td>

                        <td>

                            <b>${article.judul}</b>

                            <p>
                                <small>
                                    ${article.isi.substring(0, 50)}...
                                </small>
                            </p>

                        </td>

                        <td>${article.nama_kategori}</td>

                        <td>${article.status}</td>

                        <td>

                            <a href="/admin/artikel/edit/${article.id}">
                                Edit
                            </a>

                            |

                            <a
                                href="/admin/artikel/delete/${article.id}"
                                onclick="return confirm('Yakin mau hapus data ini?');"
                            >
                                Delete
                            </a>

                        </td>

                    </tr>
                `;
            });

        } else {

            html += `
                <tr>
                    <td colspan="5">
                        Tidak ada data.
                    </td>
                </tr>
            `;
        }

        html += `
                </tbody>

            </table>
        `;

        articleContainer.html(html);
    };

    // Render pagination
    const renderPagination = (pager, q, kategori_id) => {

        let html = '<br><div>';

        pager.links.forEach(link => {

            let url = link.url
                ? `${link.url}&q=${q}&kategori_id=${kategori_id}`
                : '#';

            html += `
                <a
                    href="${url}"
                    style="
                        margin-right:5px;
                        padding:5px 10px;
                        border:1px solid #ccc;
                        text-decoration:none;
                        ${link.active ? 'font-weight:bold;' : ''}
                    "
                >
                    ${link.title}
                </a>
            `;
        });

        html += '</div>';

        paginationContainer.html(html);
    };

    // Submit search
    searchForm.on('submit', function (e) {

        e.preventDefault();

        const q = searchBox.val();

        const kategori_id = categoryFilter.val();

        fetchData(
            `/admin/artikel?q=${q}&kategori_id=${kategori_id}`
        );
    });

    // Filter kategori realtime
    categoryFilter.on('change', function () {

        searchForm.trigger('submit');
    });

    // Klik pagination AJAX
    $(document).on(
        'click',
        '#pagination-container a',
        function (e) {

            e.preventDefault();

            const url = $(this).attr('href');

            if (url !== '#') {

                fetchData(url);
            }
        }
    );

    // Load pertama
    fetchData('/admin/artikel');

});

</script>

<?= $this->include('template/admin_footer'); ?>