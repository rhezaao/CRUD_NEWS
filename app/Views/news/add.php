<?= $this->extend('template/index') ?>           
 
<?= $this->section('content') ?>
 
                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
 
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Halaman Utama</a></li>
 
                                            <li class="breadcrumb-item"><a href="<?= base_url('news'); ?>">Daftar Berita</a></li>
 
                                            <li class="breadcrumb-item active">
 
                                                <?=$title;?>
 
                                            </li>
                                        </ol>
                                    </div>
 
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->
 
                        <div class="page-section">
                            <form action="<?= base_url(); ?>/news/save" method="post" enctype="multipart/form-data">
 
                                <div class="row card-group-row">
 
                                    <?php if (isset($validation)) { ?>
                                        <div class="col-md-12">
                                            <?php foreach ($validation->getErrors() as $error) : ?>
                                                <div class="alert alert-warning" role="alert">
                                                    <i class="mdi mdi-alert-outline me-2"></i>
                                                    <?= esc($error) ?>
                                                </div>
                                            <?php endforeach ?>
                                        </div>
                                    <?php } ?>
 
                                    <div class="col-md-12">
                                        <div class="list-group list-group-flush">
                                            <div class="list-group-item p-3">
                                                <div class="row align-items-start">
                                                    <div class="col-md-4 mb-8pt mb-md-0">
                                                        <div class="media align-items-left">
                                                            <div class="d-flex flex-column media-body media-middle">
                                                                <span
                                                                    class="card-title">Judul Berita</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mb-8pt mb-md-0">
                                                        <input name="title"
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Judul Berita" />
                                                    </div>
                                                </div>
                                            </div>
 
                                            <div class="list-group-item p-3">
                                                <div class="row align-items-start">
                                                    <div class="col-md-4 mb-8pt mb-md-0">
                                                        <div class="media align-items-left">
                                                            <div class="d-flex flex-column media-body media-middle">
                                                                <span
                                                                    class="card-title">Tanggal Terbit</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mb-8pt mb-md-0">
                                                        <input name="publish_date" type="date" class="form-control publish_date" placeholder="Tanggal Terbit" value="<?php echo set_value ('publish_date'); ?>" />
                                                    </div>
                                                </div>
                                            </div>
 
                                            <div class="list-group-item p-3">
                                                <div class="row align-items-start">
                                                    <div class="col-md-4 mb-8pt mb-md-0">
                                                        <div class="media align-items-left">
                                                            <div class="d-flex flex-column media-body media-middle">
                                                                <span
                                                                    class="card-title">Gambar</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mb-8pt mb-md-0">
                                                        <input type="file" id="image_file" name="image_file" class="form-control image_file" accept=".jpg,.png,.jpeg,.gif" />
                                                    </div>
                                                </div>
                                            </div>
 
                                            <div class="list-group-item p-3">
                                                <div class="row align-items-start">
                                                    <div class="col-md-4 mb-8pt mb-md-0">
                                                        <div class="media align-items-left">
                                                            <div class="d-flex flex-column media-body media-middle">
                                                                <span
                                                                    class="card-title">Isi Berita</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col mb-8pt mb-md-0">
                                                        <textarea name="body" style="width:100%; height: 300px">
                                                 
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
 
                                        </div>
                                    </div>
                                </div>
 
                                <div class="row">
                                    <div class="col align-items-right">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </div>
                                 
                            </form>
                        </div>
 
                     
 
<?= $this->endSection() ?>
 
<?= $this->section('script-js') ?>     
    <script language="javascript" type="text/javascript" src="<?= base_url() ?>/assets//js/tiny_mce/tiny_mce.js"></script>
    <script language="javascript" type="text/javascript">
        tinyMCE.init({
            theme : "advanced",
            mode : "textareas",
            external_image_list_url : "ext_image_list.php"
        });
    </script>
<?= $this->endSection() ?> 