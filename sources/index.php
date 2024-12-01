<?php
/**
 * index.php: homepage
 */
$pageTitle = "Home";
include("header.php");
?>
    <!-- Page Specific Content Starts -->
    <section class="welcome-section">
        <div class="container">
            <h2 class="welcome-text">Welcome to Game 'n Go!</h2>

            <div class="feature-list">
                <p>New Features in This Version:</p>
                <ul>
                    <li>Shopping Cart</li>
                    <li>Create/Update/Delete Items in Database</li>
                    <li>CSS Refinement</li>
                    <li>A Sitewide Logo</li>
                </ul>
            </div>

            <div class="contributors-list">
                <p>Contributors and their roles:</p>
                <ul>
                    <li>Jalen Vaughn: Project Manager; Back-end Developer; Software Architect</li>
                    <li>Ayah Hineiti: Mid-Project Website Designer; Front-end Developer</li>

                </ul>
            </div>

            <div class="tasks-list">
                <p>Priority Tasks:</p>
                <ul>
                    <li>Complete CSS Integration</li>
                    <li>Replace Content in Homepage with Game Related Elements</li>
                    <li>Document All PHP Pages with their purpose.</li>
                </ul>
            </div>
        </div>
    </section>


    <!-- Page Specific Content Ends -->
<?php
include("footer.php");
?>