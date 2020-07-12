<a href="/pfa/"> <img src="assets/Images/logo.png" alt="" style="position: absolute; top: 10px;right: 10px;"></a>

<img src="assets/Images/cancel.svg" alt="confirmation" class="confirmation__Img">
<p><a onclick="goBack()" class="goBack__link"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> return </a> <?= $msg ?></p>
<script>
    function goBack() {
        history.go(-1)
        return false;
    }
</script>