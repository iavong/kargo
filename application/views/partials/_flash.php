<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success">
        <?= $this->session->flashdata('success'); ?>
    </div>
<?php elseif ($this->session->flashdata('error')) : ?>
    <div class="alert alert-danger">
        <?= $this->session->flashdata('error'); ?>
    </div>
<?php elseif ($this->session->flashdata('info')) : ?>
    <div class="alert alert-info">
        <?= $this->session->flashdata('info'); ?>
    </div>
<?php elseif ($this->session->flashdata('warning')) : ?>
    <div class="alert alert-warning">
        <?= $this->session->flashdata('warning'); ?>
    </div>
<?php endif; ?>