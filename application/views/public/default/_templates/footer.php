<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!-- start footer -->
<div class="container">
      <footer id="footer">
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="float-lg-right"><a href="#top">Back to top</a></li>
              <li><a href="#" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
              <li><a href="#">RSS</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebok</a></li>
              <li><a href="#">Squidproxy</a></li>
              <li><a href="#">Donate</a></li>
            </ul>
            <p>Total Account. </p>
            <p>Total Account created by <?php echo ucwords($domain) ?> : <?php echo $total_account ?></p>
			<p>Powered By <a href="http://webssh.id" rel="nofollow">Webssh</a> Icons from <a href="http://fontawesome.io/" rel="nofollow">Font Awesome</a>. Web fonts from <a href="https://fonts.google.com/" rel="nofollow">Google</a>.</p>
		</div>
       </div>
     </footer>
   </div>

    
    <script src="<?php echo base_url('assets/default/_vendor/popper.js/dist/umd/popper.min.js');?>"></script>
    <script src="<?php echo base_url('assets/default/_vendor/bootstrap/dist/js/bootstrap.min.js');?>"></script>

  </body>
</html>
