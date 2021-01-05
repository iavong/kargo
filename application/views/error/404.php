<?php $this->load->view('layout/header'); ?>
<div class="error-page d-flex align-items-center flex-wrap justify-content-center pd-20">
    <div class="pd-10">
        <div class="error-page-wrap text-center">
            <h1>404</h1>
            <h3>Error: 404 Page Not Found</h3>
            <p>Sorry, the page you’re looking for cannot be accessed.<br>Either check the URL</p>
            <div class="pt-20 mx-auto max-width-200">
                <a href="##" onClick="history.go(-1); return false;" class="btn btn-primary btn-block btn-lg">Back To Home</a>
            </div>
        </div>
    </div>
</div>
<!-- js -->
<?php $this->load->view('layout/footer'); ?>