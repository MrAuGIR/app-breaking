<?php
/*
 * File: addgame.php
 * Description: This script displays a form to add game information that will be
 * entered into the database when sent.
 *
 */
$pageTitle = "Add game";
require_once 'header.php';

# Deny entry for unauthorized users
if ($_SESSION['role'] != 1) {
    raiseError("Direct Access to this page is forbidden");
}
?>
    <section>
        <div class="form-container">
        <h2>Add New Game</h2>
        <form action="includes/crud/insertgame.inc.php" method="post">

            <table cellspacing="0" cellpadding="3" style="border: 1px solid silver; padding:5px; margin-bottom: 10px">

                <tr>
                    <td style="text-align: right; width: 100px">Title:</td>
                    <td><input name="title" type="text" maxlength="50" size="50" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right">Genre:</td>
                    <td>
                        <select name="genre">
                            <option>Action-Adventure</option>
                            <option>Action-Role Playing</option>
                            <option>First-Person Shooter</option>
                            <option>Life Simulation</option>
                            <option>Sports</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Developer:</td>
                    <td>
                        <select name="developer">
                            <option>343 Industries</option>
                            <option>CD Projekt Red</option>
                            <option>EA Tiburon</option>
                            <option>Nintendo EPD</option>
                            <option>Rockstar Studios</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Publisher:</td>
                    <td>
                        <select name="publisher">
                            <option>CD Projekt</option>
                            <option>EA Sports</option>
                            <option>Nintendo</option>
                            <option>Rockstar Games</option>
                            <option>Xbox Game Studios</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Rating:</td>
                    <td><input name="rating" type="number" step="0.1" min="0.0" max="10.0" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right">ESRB:</td>
                    <td>
                        <select name="esrb">
                            <option>Everyone</option>
                            <option>Everyone 10+</option>
                            <option>Mature 17+</option>
                            <option>Rating Pending</option>
                            <option>Teen</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td style="text-align: right">Image:</td>
                    <td><input name="image" type="text" maxlength="100" size="100" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right">Release Date:</td>
                    <td><input name="release_date" type="text" placeholder="YYYY-MM-DD" pattern="\d{4}-\d{2}-\d{2}"
                               title="Please enter the release date in the format YYYY-MM-DD" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right; vertical-align: top">Price:</td>
                    <td><input name="price" type="number" step="0.01" required/></td>
                </tr>

                <tr>
                    <td style="text-align: right; vertical-align: top">Description:</td>
                    <td><textarea name="description" maxlength="5000" rows="6" cols="65"></textarea></td>
                </tr>

            </table>

            <div>
                <input type="submit" value="Add Game"/>
                <input type="button" value="Cancel" onclick="window.location.href='listgames.php'"/>
            </div>

        </form>
    </section>
<?php
require_once 'footer.php';