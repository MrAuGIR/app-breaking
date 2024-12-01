<?php
/*
 * Author: Jalen Vaughn
 * Date: 11/25/23
 * File: error.php
 * Description: This script displays an error message.
 *
 */

// Initial Page Requirements
$pageTitle = "Error";
include("header.php");

// Declare default statement
$error = 'Default error.';

// Validate string
if (filter_has_var(INPUT_GET, "m")) {
    $error = filter_input(INPUT_GET, 'm', FILTER_SANITIZE_STRING);
}
?>

    <section>
        <div class="container">
            <h2>Error</h2>

            <table style="width: 100%; border: none">
                <tr>
                    <td style="text-align: left; vertical-align: top;">
                        <h3>Sorry, but an error has occurred.</h3>
                        <div style="color: red">
                            <?= $error ?>
                        </div>
                        <br>
                    </td>
                </tr>
            </table>
            <br><br><br><br><br>
    </section>
<?php
require_once 'footer.php';
