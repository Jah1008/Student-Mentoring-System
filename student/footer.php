  <!-- Main Footer -->
  </div>
  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="https://adminlte.io">Student Mentoring System</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../plugins/raphael/raphael.min.js"></script>
<script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>


<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard2.js"></script>



</script>

<!-- Subject -->
<script>
  (function(){
    var path = window.location.href;
    // console.log(path);
    $(".nav-link").each(function () {

      var href = $(this).attr('href');
      // console.log(href);
      if (path === decodeURIComponent(href)) 
      {
        $(this).addClass('active');
        var parent = $(this).closest('.has-treeview');
        parent.addClass('menu-open');
        $(parent).find('.nav-link').first().addClass('active');
        // console.log(parent);
      };
    });
  }());
</script>








</body>
</html>
