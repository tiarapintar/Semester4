<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="mb-4">Detail Buku</h2>
            <div class="card mb-3" style="max-width: 600px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $buku['sampul']; ?>" class="img-fluid rounded-start"
                            alt="<?= $buku['judul']; ?>">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $buku['judul']; ?></h5>
                            <p class="card-text"><strong>Penulis :</strong> <?= $buku['penulis']; ?></p>
                            <p class="card-text">
                                <small class="text-body-secondary"><b>Penerbit :</b> <?= $buku['penerbit']; ?></small>
                            </p>

                            <a href="/books/edit/<?= $buku['slug']; ?>" class="btn btn-warning">Edit</a>

                            <!-- Form Hapus -->
                            <form action="/books/<?= $buku['id']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>

                            <br><br>
                            <a href="/books">Kembali ke Daftar Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
