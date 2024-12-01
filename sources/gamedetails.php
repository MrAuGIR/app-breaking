<?php
/**
 * Author: Jalen Vaughn
 *  Date: 11/16/23
 * File: gamedetails.php
 *  Description: This script displays details of a particular game.
 */

// Initial Page Requirements
$pageTitle = "Game Details";
require('header.php');

// Connect to Database
connect();

// Retrieve and validate game id
$id = getValidation(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Execute query with statement
/** @var $tableGames */
$query = runQuery("SELECT * FROM $tableGames WHERE id=$id");

// Get data associated with query
$rows = fetchData($query);
?>

    <section>
        <div class="game-details-container">
        <h2>Game Details</h2>
        <table>
            <?php foreach ($rows as $row) { ?>
                <!-- Display Game image -->
                <tr>
                    <td colspan="2"><img src="<?= $row['image'] ?>" alt=""></td>
                </tr>

                <!-- Display Game Attributes -->
                <tr>
                    <td>Title:</td>
                    <td><?= $row['title'] ?></td>
                </tr>
                <tr>
                    <td>Developer:</td>
                    <td><?= $row['developer'] ?></td>
                </tr>
                <tr>
                    <td>Genre:</td>
                    <td><?= $row['genre'] ?></td>
                </tr>
                <tr>
                    <td>ESRB:</td>
                    <td><?= $row['esrb'] ?></td>
                </tr>
                <tr>
                    <td>Release Date:</td>
                    <td><?= $row['release_date'] ?></td>
                </tr>
                <tr>
                    <td>Publisher:</td>
                    <td><?= $row['publisher'] ?></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><?= $row['price'] ?></td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td><?= $row['description'] ?></td>
                </tr>
            <?php } ?>
            <?php
            $confirm = "";
            if (isset($_GET['m'])) {
                if ($_GET['m'] == "insert") {
                    $confirm = "You have successfully added the new game.";
                } else if ($_GET['m'] == "update") {
                    $confirm = "Your game has been successfully updated.";
                }
            }
            ?>
            <tr>
                <td colspan="2">
                    <input type="button"
                           onclick="window.location.href='includes/shopping/addtocart.inc.php?id=<?= $id ?>';"
                           value="Add to Cart"/>
                    <input type="button"
                           onclick="window.location.href='listgames.php'"
                           value="Back to Games List">
                    <?php
                    // Display buttons only if user is admin
                    if ($_SESSION['role'] == 1) {

                        ?>
                        <input type="button"
                               onclick="window.location.href='editgame.php?id=<?= $id ?>'"
                               value="Edit">
                        <input type="button" value="Delete"
                               onclick="window.location.href='deletegame.php?id=<?= $id ?>'">


                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        <div style="color: red; display: inline-block;"><?= $confirm ?></div>
    </section>
<?php

disconnect();
include('footer.php');