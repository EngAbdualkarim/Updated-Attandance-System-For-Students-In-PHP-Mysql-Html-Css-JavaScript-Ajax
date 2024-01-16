<style>
    .page-loading{
        display: none;
        z-index: 999999;
        position: absolute;
        background-color: #333333;
        opacity: 0.5;
        height: 100%;
        width: 100%;
        color: white;
        text-align: center;
        padding-top: 15%;
    }

    .alert-success, .alert-danger, .alert-warning{
        position: absolute !important;
        text-align: center;
        display: none;
        width: 100%;
        top: 0;
        z-index: 9999;
    }

</style>
<div class="alert alert-success">
    <span class="success_span">test success msg</span>
</div>
<div class="alert alert-danger">
    <span class="error_span">test danger msg</span>
</div>
<div class="alert alert-warning">
    <span class="warning_span">test warning msg</span>
</div>

<div class="page-loading">
    <img src="../uploads/loader.gif" alt="" class="loading">
    <span>  Processing...</span>
</div>

