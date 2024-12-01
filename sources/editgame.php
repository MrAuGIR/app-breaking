<?php
/**
 * Allows admins to edit the details of a game
 */
$pageTitle = "Edit Game Details";
require_once('header.php');

# Deny entry for unauthorized users
if ($_SESSION['role'] != 1) {
    raiseError("Direct Access to this page is forbidden");
}

// Connect to Database
connect();

// Get and validate query string variable "id"
$id = getValidation(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

// Run query that selects the required id
/** @var $tableGames */
$query = runQuery("SELECT * FROM $tableGames WHERE id=$id");

// Assign data to $rows
$rows = fetchData($query);
?>

    <section>
        <h2>Edit Game Details</h2>
        <form action="includes/crud/updategame.inc.php" method="post">
            <table cellspacing="0" cellpadding="3" style="border: 1px solid silver; padding:5px; margin-bottom: 10px">
                <?php foreach ($rows as $row) { ?>
                <tr>
                    <td style="text-align: right; width: 100px">Title:</td>
                    <td><input name="title" value="<?php echo $row['title'] ?>" type="text" maxlength="50" size="50" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right">Genre:</td>
                    <td>
                        <select name="genre">
                            <option <?= $row['genre'] == 'Action-Adventure' ? 'selected' : ''; ?>>Action-Adventure</option>
                            <option <?= $row['genre'] == 'Action-Role Playing' ? 'selected' : ''; ?>>Action-Role Playing</option>
                            <option <?= $row['genre'] == 'First-Person Shooter' ? 'selected' : ''; ?>>First-Person Shooter</option>
                            <option <?= $row['genre'] == 'Life Simulation' ? 'selected' : ''; ?>>Life Simulation</option>
                            <option <?= $row['genre'] == 'Sports' ? 'selected' : ''; ?>>Sports</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Developer:</td>
                    <td>
                        <select name="developer">
                            <option <?= $row['developer'] == '343 Industries' ? 'selected' : ''; ?>>343 Industries</option>
                            <option <?= $row['developer'] == 'CD Projekt Red' ? 'selected' : ''; ?>>CD Projekt Red</option>
                            <option <?= $row['developer'] == 'EA Tiburon' ? 'selected' : ''; ?>>EA Tiburon</option>
                            <option <?= $row['developer'] == 'Nintendo EPD' ? 'selected' : ''; ?>>Nintendo EPD</option>
                            <option <?= $row['developer'] == 'Rockstar Studios' ? 'selected' : ''; ?>>Rockstar Studios</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Publisher:</td>
                    <td>
                        <select name="publisher">
                            <option <?= $row['publisher'] == 'CD Projekt' ? 'selected' : ''; ?>>CD Projekt</option>
                            <option <?= $row['publisher'] == 'EA Sports' ? 'selected' : ''; ?>>EA Sports</option>
                            <option <?= $row['publisher'] == 'Nintendo' ? 'selected' : ''; ?>>Nintendo</option>
                            <option <?= $row['publisher'] == 'Rockstar Games' ? 'selected' : ''; ?>>Rockstar Games</option>
                            <option <?= $row['publisher'] == 'Xbox Game Studios' ? 'selected' : ''; ?>>Xbox Game Studios</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Rating:</td>
                    <td><input name="rating" value="<?php echo $row['rating'] ?>" step="0.1" min="0.0" max="10.0" type="number" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right">ESRB:</td>
                    <td>
                        <select name="esrb">
                            <option <?= $row['esrb'] == 'Everyone' ? 'selected' : ''; ?>>Everyone</option>
                            <option <?= $row['esrb'] == 'Everyone 10+' ? 'selected' : ''; ?>>Everyone 10+</option>
                            <option <?= $row['esrb'] == 'Mature 17+' ? 'selected' : ''; ?>>Mature 17+</option>
                            <option <?= $row['esrb'] == 'Rating Pending' ? 'selected' : ''; ?>>Rating Pending</option>
                            <option <?= $row['esrb'] == 'Teen' ? 'selected' : ''; ?>>Teen</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Image:</td>
                    <td><input name="image" value="<?php echo $row['image'] ?>" type="text" maxlength="100" size="100" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right">Release Date:</td>
                    <td><input name="release_date" value="<?php echo $row['release_date'] ?>" type="text"
                               pattern="\d{4}-\d{2}-\d{2}" title="Please enter the release date in the format YYYY-MM-DD" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right; vertical-align: top">Price:</td>
                    <td><input name="price" value="<?php echo $row['price'] ?>" type="number" step="0.01" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right; vertical-align: top">Description:</td>
                    <td><textarea name="description" maxlength="5000" rows="6" cols="65"><?php echo $row['description'] ?></textarea></td>
                </tr>
                <?php } ?>
            </table>

            <div>
                <input type="hidden" name="id" value="<?php echo $id ?>" />
                <input type="submit" value="Update"/>
                <input type="button" value="Cancel" onclick="window.location.href='listgames.php'"/>
            </div>
        </form>
    </section>
<?php
// Disconnect from Database.
disconnect();
require_once 'footer.php';
