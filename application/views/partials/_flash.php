<?php if ($this->session->flashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
        <strong>Success!</strong> <?= $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif ($this->session->flashdata('error')) : ?>
    <div class="alert alert-error alert-dismissible fade show shadow" role="alert">
        <strong>Error!</strong> <?= $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif ($this->session->flashdata('info')) : ?>
    <div class="alert alert-info alert-dismissible fade show shadow" role="alert">
        <strong>Info!</strong> <?= $this->session->flashdata('info'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php elseif ($this->session->flashdata('warning')) : ?>
    <div class="alert alert-warning alert-dismissible fade show shadow" role="alert">
        <strong>Warning!</strong> <?= $this->session->flashdata('warning'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>