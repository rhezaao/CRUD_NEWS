<?= $this->extend('template/index.php') ?>;          

<?= $this->section('content'); ?>
<h1 class="h3 mb-4 text-gray-800">News</h1>

<form class="user">
                        <input type="hidden" name="page" value="<?= $page; ?>" />
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input name="title"
                                    type="text"
                                    class="form-control form-control-user"
                                    placeholder="Judul Berita" value="<?= $vartitle; ?>"/>
                            </div>
                            <div class="col-sm-6">
                                <input name="publish_date"
                                    type="date"
                                    class="form-control form-control-user"
                                    placeholder="Tanggal Terbit" value="<?= $publish_date; ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <input name="body"
                                type="text"
                                class="form-control form-control-user"
                                placeholder="Isi Berita" value="<?= $body; ?>"/>
                        </div>
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-success">Cari Berita</button>
                                </div>
                                <div class="col-sm-6">
                                    <a href="<?= base_url(); ?>/news/add" class="btn btn-success float-right">Tambah Berita</a>
                                </div>
                            </div>
                            <?= $pager->makeLinks($page, $per_page, $count_all, 'bootstrap-bullet_pagination') ?>
                        </div>
                    </form>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Berita</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Slug</th>
                                            <th>Tanggal</th>
                                            <th style="width: 90px;"></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Judul</th>
                                            <th>Slug</th>
                                            <th>Tanggal</th>
                                            <th style="width: 90px;"></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($news as $row): ?>
                                        <tr>
                                            <td><?= $row->id; ?></td>
                                            <td><?= $row->title; ?></td>
                                            <td><?= $row->slug; ?></td>
                                            <td><?= $row->publish_date; ?></td>
                                            <td>
                                                 <a href="<?= base_url('news/edit/' . $row->id); ?>" class="btn btn-warning btn-circle btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                 </a>
                                                 <a href="#" class="btn btn-danger btn-circle btn-sm btn-delete-news" data-toggle="modal" data-target="#deleteModalNews" data-id="<?= $row->id; ?>">
                                                    <i class="fas fa-trash"></i>
                                                 </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
<?= $this->endSection() ?>;

<?= $this->section('div-modal') ?>  
    <!-- Modal Delete News-->
    <form action="<?= base_url(); ?>/news/delete" method="post">
        <div class="modal fade" id="deleteModalNews" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Berita</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
              
               <h4>Apakah Anda yakin menghapus data ini?</h4>
              
            </div>
            <div class="modal-footer">
                <input type="hidden" name="id" class="id">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-success">Ya</button>
            </div>
            </div>
        </div>
        </div>
    </form>
    <!-- End Modal Delete Status-->
<?= $this->endSection() ?> 
 
<?= $this->section('script-js') ?>     
<script>
    $(document).ready(function(){
        // get Delete News
        $('.btn-delete-news').on('click',function(){
            // get data from button edit
            const id = $(this).data('id');
            // Set data to Form Edit
            $('.id').val(id);
            // Call Modal Edit
            $('#deleteModalNews').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>