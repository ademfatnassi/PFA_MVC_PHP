<a href="/pfa/"> <img src="assets/Images/logo.png" alt="" style="position: absolute; top: 10px;right: 10px;"></a>

<img src="assets/Images/confirmation.svg" alt="confirmation" class="confirmation__Img">
<p>You will be redirected to log IN page in <span id="counter">5</span> second(s).</p>
<script type="text/javascript">
    function countdown() {
        var i = document.getElementById('counter');
        if (parseInt(i.innerHTML) <= 0) {
            location.href = 'index/client/login/';
        }
        if (parseInt(i.innerHTML) != 0) {
            i.innerHTML = parseInt(i.innerHTML) - 1;
        }
    }
    setInterval(function() {
        countdown();
    }, 1000);
</script>