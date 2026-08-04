	<div class="container-fluid page_footer">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6">
					<p>
						<a href="https://tradeboost.eu"><img src="https://tradeboost.eu/image/icons/flags/eu.png" class="footer-flag" alt="EU flag"></a>  
						<a href="https://tradeboost.at"><img src="https://tradeboost.eu/image/icons/flags/austria.png" class="footer-flag" alt="austria"></a>  
						<a href="https://tradeboost.fr"><img src="https://tradeboost.eu/image/icons/flags/france.png" class="footer-flag" alt="france"></a>  
						<a href="https://tradeboost.es"><img src="https://tradeboost.eu/image/icons/flags/spain.png" class="footer-flag" alt="spain"></a>  
						<a href="https://tradeboost.ch"><img src="https://tradeboost.eu/image/icons/flags/switzerland.png" class="footer-flag" alt="switzerland"></a>  
						<a href="https://trade-boost.de"><img src="https://tradeboost.eu/image/icons/flags/germany.png" class="footer-flag" alt="germany"></a>  
						<a href="https://tradeboost.nl"><img src="https://tradeboost.eu/image/icons/flags/netherlands.png" class="footer-flag" alt="netherlands"></a>  
						<a href="https://tradeboost.be"><img src="https://tradeboost.eu/image/icons/flags/belgium.png" class="footer-flag" alt="belgium"></a>  
						<a href="https://trade-boost.co.uk"><img src="https://tradeboost.eu/image/icons/flags/united-kingdom.png" class="footer-flag" alt="united kingdom"></a>  
						<a href="https://tradeboost.se"><img src="https://tradeboost.eu/image/icons/flags/sweden.png" class="footer-flag" alt="sweden"></a>

					</p>
				</div>
				<div class="col-12 col-md-6 text-right">
					<p>
						Copyright Trade boost <?php echo date('Y') ?>
						<br><small><a href="/privacy" style="color:#ffffff">Privacy policy</a></small>
			        	<br><small><a href="/about" style="color:#ffffff"><?php echo ucfirst($translation[$page_language]['about_us']); ?></a></small>
			        	<br><small><a href="/blog" style="color:#ffffff">Blog</a></small>
					</p>
				</div>				
			</div>
		</div>
	</div>
	<script>
	function setCookie(name,value) {
		eraseCookie(name);
	    var expires = "";
        var date = new Date();
        date.setTime(date.getTime() + (365*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
	    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
	    location.reload();
		return false;
	}
	function getCookie(name) {
	    var nameEQ = name + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0;i < ca.length;i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1,c.length);
	        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
	    }
	    return null;
	}
	function eraseCookie(name) {   
	    document.cookie = name+'=; Max-Age=-99999999;';  
	}
	</script>


		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

		<script data-ad-client="ca-pub-1161048397659913" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	
	</body>
</html>