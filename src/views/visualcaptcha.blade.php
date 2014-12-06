<link rel="stylesheet" href="assets/css/visualcaptcha.css">
<script src="assets/js/visualcaptcha.jquery.js"></script>
<div id="visualcaptcha"></div>
<script>
	var el = $( '#visualcaptcha' ).visualCaptcha( {{  json_encode($captcha) }} );
	var captcha = el.data( 'captcha' );
</script>
