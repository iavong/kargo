<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">

            <?php $this->load->view('partials/_flash'); ?>

            <div class="pd-20 bg-white border-radius-4 box-shadow mb-20">
                <div class="clearfix mb-20">
                    <div class="pull-left">
                        <h4 class="text-blue h4"><?= $title; ?></h4>
                        <!-- <p>Add class <code>.table</code></p> -->
                    </div>
                    <div class="pull-right">
                        <a href="<?= base_url('harga/tambah'); ?>" class="btn btn-primary btn-sm scroll-click" rel="content-y"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <hr>


                <div class="pb-20">
                    <table class="table stripe hover nowrap" id="dataTable">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Berat</th>
                                <th>Kota Tujuan</th>
                                <th>Biaya</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($harga->result() as $row) : ?>
                                <tr>
                                    <td class="table-plus"><?= $row->berat . ' Kg'; ?></td>
                                    <td><?= strtoupper($row->kota_tujuan); ?></td>
                                    <td><?= rupiah($row->biaya); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="<?= base_url('harga/edit/' . $row->id); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                                <!-- <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a> -->

                                                <!-- delete -->
                                                <form action="<?= base_url('harga/delete'); ?>" method="post" class="d-inline">
                                                    <input type="hidden" name="id" value="<?= $row->id; ?>" hidden>
                                                    <button onclick="return confirm('Apa anda yakin ?');" class="dropdown-item" title="Delete"><i class="dw dw-delete-3"></i> Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>



        </div>



        <?php $this->load->view('layout/partials/_footer'); ?>


    </div>
</div>