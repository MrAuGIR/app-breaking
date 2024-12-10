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
$id = $_GET['id'];

// Execute query with statement
/** @var $tableGames */
$query = runQuery("SELECT * FROM $tableGames WHERE id=$id");

/** @var $commentTable */
$queryComment = runQuery("SELECT * FROM $commentTable WHERE id_game=$id");

// Get data associated with query
$rows = fetchData($query);

$comments = fetchData($queryComment);
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
                    if ($_COOKIE['role'] == "admin") {

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
    if(isset($_SESSION["name"])): 
?>
    <section class="game-details-container">
        <form class="form-comment" method="POST" action="includes/comment/addComment.inc.php">
            <input type="text" name="username" id="username" value="<?= $_SESSION['name'] ?>" hidden>
            <input type="text" name="id_game" id="id_game" value="<?= $id ?>" hidden>
            <label for="commentText">Commentaire</label>
            <textarea id="commentText" type="text" name="comment"></textarea>
            <button type="submite">Soumettre votre commentaire</button>
        </form>
    </section>
<?php
    endif;
?>
    <section class="game-details-container">
        <?php foreach($comments as $comment) : ?>
            <div class="comment">
                <h4><?= $comment['username'] ?></h4>
                <p><?= $comment['comment'] ?></p>
                <div class="action">
                    <input type="button"
                           onclick="window.location.href='includes/comment/deleteComment.inc.php?id=<?= $comment['id'] ?>&game=<?= $id ?>' ;"
                           value="delete comment"/>
                </div>
            </div>

        <?php endforeach; ?>
    </section>
<?php

disconnect();
include('footer.php');