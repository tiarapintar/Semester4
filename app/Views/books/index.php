<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">

            <!-- Pesan Flashdata -->
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            <h1 class="mt-2">Daftar Buku</h1>

            <?php if (empty($buku)) : ?>
                <div class="alert alert-warning">Tidak ada data buku.</div>
            <?php else : ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Sampul</th>
                            <th>Judul</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($buku as $b) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $b['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $b['judul']; ?></td>
                            <td><a href="<?= site_url('books/' . $b['slug']); ?>" class="btn btn-success">Detail</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                 <!-- Tombol Tambah -->
            <a href="/books/create" class="btn btn-primary mb-3">Tambah Data Buku</a>
            <?php endif; ?>

        </div>
    </div>
</div>
<?= $this->endSection(); ?>
