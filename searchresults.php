<?php
/**
 * Author: Jalen Vaughn
 * Date: 11/13/23
 * File: searchresults.php
 * Description: This script searches for games that match game titles in the database.
 */

// Initial Page Requirements
$pageTitle = "Search Results";
require('header.php');

// Connect to Database
connect();

// Retrieve and validate search terms
$term = getValidation(INPUT_GET, 'q');

// Search for games using terms
$rows = searchGames($term);

// Display the results
?>
    <section>
        <div class="container">
        <h2>Games in our store - <?= count($rows) ?> Result(s)</h2>
        <?php if (count($rows) == 0) {
            exit("No games were found in the search.");
        } ?>
        <div>
            <table>
                <tr>
                    <td>Title</td>
                    <td>Genre</td>
                    <td>ESRB</td>
                    <td>Price</td>
                </tr>
                <!-- PHP code to list search result from the "games" table -->
                <?php foreach ($rows as $row) { ?>
                    <tr>
                        <td><a href="gamedetails.php?id=<?= $row['id'] ?>"><?= $row['title'] ?></a></td>
                        <td><?= $row['genre'] ?></td>
                        <td><?= $row['esrb'] ?></td>
                        <td><?= $row['price'] ?></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </section>
<?php
disconnect();
include('footer.php');
