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
                        <a href="<?= base_url('pengirim-hutang/tambah'); ?>" class="btn btn-primary btn-sm scroll-click" rel="content-y"><i class="fa fa-plus"></i> Tambah</a>
                    </div>
                </div>
                <hr>


                <div class="pb-20">
                    <table class="table stripe hover nowrap table-responsive" id="dataTable">
                        <thead>
                            <tr>
                                <th class="table-plus datatable-nosort">Name</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Hutang</th>
                                <th>Tanggal Join</th>
                                <th class="datatable-nosort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pengirimhutang->result() as $row) : ?>
                                <tr style="text-transform: uppercase;">
                                    <td class="table-plus"><?= ucwords($row->nama); ?></td>
                                    <td><?= $row->no_hp; ?></td>
                                    <td><?= $row->alamat; ?> </td>
                                    <td><?= rupiah($row->deposit); ?></td>
                                    <td><?= date('H:i - d M Y', strtotime($row->created_at)); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                                <i class="dw dw-more"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                                <a class="dropdown-item" href="<?= base_url('pengirim-hutang/bayar/' . $row->id); ?>"><i class="dw dw-money"></i>Hutang</a>
                                                <a class="dropdown-item" href="<?= base_url('pengirim-hutang/edit/' . $row->id); ?>"><i class="dw dw-edit2"></i> Edit</a>
                                                <!-- delete -->
                                                <form action="<?= base_url('pengirim-hutang/delete'); ?>" method="post" class="d-inline">
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