<!-- Modal -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="TambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= site_url("tahun/insert") ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="text" class="form-control" id="tahun" name="tahun" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="insertdata" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Tahun</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php

            if ($this->session->flashdata('message')) {
                echo "<div class='alert alert-primary'>  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button> " . $this->session->flashdata('message') . "</div>";
            }

            ?>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah"><i
                    class="fas fa-fw fa-plus-circle"></i>Tambah</button>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <?php $i = $this->uri->segment('3') + 1; ?>
                <?php foreach ($tahun as $key) : ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $key->tahun; ?></td>
                    <td>
                        <a href="<?= site_url('tahun/edit/' . $key->id_tahun) ?>" class="btn btn-primary"><i
                                class="far fa-fw fa-edit"></i></a>
                        <a onclick="return confirm('Yakin?');" href="<?= site_url('tahun/hapus/' . $key->id_tahun) ?>"
                            class="btn btn-primary"><i class="fas fa-fw fa-trash-alt"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="row">
                <div class="col">
                    <?= $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- /.container-fluid -->