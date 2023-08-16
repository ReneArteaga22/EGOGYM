<!DOCTYPE html>
<html lang="en">
<head>
  <title>EntrenamientoPersonal</title>
  

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

      <!-- SCRIPTS -->
      <script src="../../js/jquery.min.js"></script>
      <script src="../../js/bootstrap.min.js"></script>
      <script src="../../js/aos.js"></script>
      <script src="../../js/smoothscroll.js"></script>
      <script src="../../js/custom.js"></script>

     <link rel="stylesheet" href="../../css/bootstrap.min.css">
     <link rel="stylesheet" href="../../css/font-awesome.min.css">
     <link rel="stylesheet" href="../../css/aos.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../../css/egogym.css">

</head>
  
<body>
<script>
     $(document).ready(function () {
      $('a[data-toggle="tab"]').on('click', function (e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
      });

      var activeTab = localStorage.getItem('activeTab');

      if (activeTab) {
        $('#myTab a[href="' + activeTab + '"]').show('tab');
      }

      $('.tabs .tab-links a').on('click', function (e) {
        var currentAttrValue = jQuery(this).attr('href');
        // Show/Hide Tabs
        jQuery('.tabs ' + currentAttrValue).siblings().slideUp(400);
        jQuery('.tabs ' + currentAttrValue).delay(400).slideDown(400);
        // Change/remove current tab to active
        jQuery(this).parent('li').addClass('active').siblings().removeClass('active');
        e.preventDefault();
      });
      $('#btnLock').click(function () {
        $('#lockForm').submit();
      });
      $(window).on('load',function () {
        $(localStorage.getItem('activeTab')).show();
      });
    });
  </script>
  <div class="container">
  <div class="tabs" align="center">
    <ul class="tab-links">
      <li class="active"><a data-toggle="tab" href="#tabs-1">Register</a></li>
      <li><a data-toggle="tab" href="#tabs-2">Lock</a></li>
    </ul>
    <div class="tab-content">
      <div id="tabs-1" class="tab-pane active" style="border: 1px solid blue;display:none;">
        <form>
          <div class="plinput"><input id="btnRegister" class="button" type="submit" name="Register"></div>
        </form>
      </div>
      <div id="tabs-2" class="tab-pane fade" style="border: 1px solid red;display:none;">
        <form>
        <div class="plinput"><input id="btnLock" class="button" type="submit" name="Login"></div>
        </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>