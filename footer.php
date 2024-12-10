<!--Footer split from content pages-->
    </body>
<!--Body Tag ends-->

<!-- Footer Tag Starts -->
<footer>
    <hr/>
    &copy <?php echo date("Y") ?> Game n' Go. All Rights Reserved.
    <br>
    <a target="_blank" href="https://github.com/tchipcorp/app-breaking">Code available here <i class="fa-brands fa-github"></i></a>
</footer>
<script>
    if(!getCookie("username")) {
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
