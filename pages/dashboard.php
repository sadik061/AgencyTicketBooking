<?php include '../pages/templates/head.html'; ?>



<body>
  <div id="wrapper">


<?php

    include '../pages/templates/headermenu.html';
    include '../pages/templates/sidemenu.html';
    include '../pages/templates/footer.html';
?>


<div id="page-wrapper">
  <?php

  if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
    // true then header redirect it to the home page directly
  {
      echo "bal";
      echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
     exit();
    /* Redirect browser */

  }
  else
  {
    echo "bal2";
    //echo '<script type="text/javascript"> window.open("../dashboard.php","_self");</script>';
    //exit();
  }
  ?>
<h1>Add your code here</h1>



</div
</div>






</body>
</html>
