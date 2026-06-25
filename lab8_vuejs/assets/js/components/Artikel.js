const Artikel = {

    template: `
    <div>

        <h2>Data Artikel</h2>

        <table>

            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Isi</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <tr
                    v-for="(row,index) in artikel"
                    :key="row.id"
                >

                    <td>{{ index + 1 }}</td>

                    <td>{{ row.judul }}</td>

                    <td>{{ getKategori(row.id_kategori) }}</td>

                    <td>{{ row.isi }}</td>

                    <td>
                        <img
                            :src="getImage(row.gambar)"
                            width="80"
                            v-if="row.gambar"
                        >
                    </td>

                    <td>

                        <a
                            href="#"
                            @click.prevent="edit(row)"
                        >
                            Edit
                        </a>

                        |

                        <a
                            href="#"
                            @click.prevent="hapus(index,row.id)"
                        >
                            Hapus
                        </a>

                    </td>

                </tr>

            </tbody>

        </table>

    </div>
    `,

    data() {
        return {
            artikel: []
        }
    },

    methods: {

        loadData() {

            axios.get(apiUrl)

            .then(response => {

                this.artikel = response.data.artikel;

            })

            .catch(error => {

                console.log(error);

            });

        },

        getKategori(id) {

            const kategori = {

                1: "Sistem Informasi",
                2: "Informatika",
                3: "Sistem Operasi",
                4: "Rekayasa Perangkat Lunak"

            };

            return kategori[id] || "Tidak Ada";
        },

        getImage(file) {

            return "http://localhost:8080/gambar/" + file;
        },

        edit(row) {

            alert(
                "Edit Artikel : " + row.judul
            );

        },

        hapus(index,id) {

            if(confirm("Yakin hapus data ?")) {

                this.artikel.splice(index,1);

                alert(
                    "Data berhasil dihapus (Frontend)"
                );
            }
        }

    },

    mounted() {

        this.loadData();

    }

};