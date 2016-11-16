    </article>
   </div>
  </div>
  
  <div class="container">
   <div class="row">
    <div class="footer">
    <div class="col-sm-2 col-sm-offset-1">&nbsp;</div>
    <div class="col-sm-9">The Alma Jordan Library</div>
    </div>
   </div>
  </div>
  
  
  
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  <!-- Include owl js plugin -->
  <script src="<?php echo base_url(); ?>assets/owl-carousel/owl.carousel.js"></script>
  <script type="text/javascript">
   $(document).ready(function() {
    $("#slider").owlCarousel({
      autoPlay: 3000, //Set AutoPlay to 3 seconds
      items : 4, //$("#slider").attr("data-numItems"),
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3]
    });
   }); 
  </script>
 </body>
</html>