<?php include '../pages/templates/head.html'; ?>

<?php  session_start();

?>

<body>
<div id="wrapper">
    <?php

    include '../pages/templates/headermenu.html';
    include '../pages/templates/sidemenu.html';
    include '../pages/templates/footer.html';
    ?>

        <?php

        if(!isset($_SESSION['loggedIn']))   // Checking whether the session is already there or not if
            // true then header redirect it to the home page directly
        {
            echo '<script type="text/javascript"> window.open("../index.php","_self");</script>';            //  On Successful Login redirects to home.php
            exit();
            /* Redirect browser */

        }

        ?>

        <script type="text/javascript">
            function reset() {
                var allInputFields=document.getElementsByTagName("input");
                for (var i = 1; i < allInputFields.length; i++) {
                    allInputFields[i].value="";
                }

            }
        </script>



</body>
</html>
