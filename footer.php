<!--Footer split from content pages-->
    </body>
<!--Body Tag ends-->

<!-- Footer Tag Starts -->
<footer>
    <hr/>
    &copy <?php echo date("Y") ?> Game n' Go. All Rights Reserved.
</footer>

<script>
    if(!getCookie("usename")) {
        document.cookie = "username=<?php echo $_SESSION['login'] ?? '' ?>";
    }
    if(!getCookie("role")) {
        document.cookie = "role=<?php echo $_SESSION['role'] ?? '' ?>";
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }
</script>     

</html>