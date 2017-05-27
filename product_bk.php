<?php
$TITLE="product";
$style="product";
require_once "header.php";
?>

    <section class="jumbotron text-center">
        <div class="container">
            <h1 class="jumbotron-heading">VISION</h1>
            <p class="lead">VISION provides information of popular movies. If you like a movie, sign in and buy a DVD easily. </p>
            <div>
                <a href="#prod" class="btn btn-info">Products</a>
                <a href="getproduct.php?action=last" class="btn btn-secondary">5 last visited movies</a>
                <a href="getproduct.php?action=most" class="btn btn-success">5 most visited movies</a>
            </div>
        </div>
    </section>
    
    <a name="prod"></a>
    <div class="album text-muted">
        <div class="container">
            
            <div class="row">
                <div class="card">
                    <a href="getproduct.php?movie_id=tt0167260"><img src="img/TheLordoftheRings.jpg" alt="The Lord of the Rings: The Return of the King poster" height="400px" width="300px"></a>
                    <p class="card-text">Gandalf and Aragorn lead the World of Men against Sauron's army to draw his gaze from Frodo and Sam as they approach Mount Doom with the One Ring.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt2562232"><img src="img/Birdman.jpg" alt="Birdman poster" height="400px" width="300px"></a>
                    <p class="card-text">Illustrated upon the progress of his latest Broadway play, a former popular actor's struggle to cope with his current life as a wasted actor is shown.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt2024544"><img src="img/slave.jpg" alt="12 Years a Slave poster" height="400px" width="300px"></a>
                    <p class="card-text">In the antebellum United States, Solomon Northup, a free black man from upstate New York, is abducted and sold into slavery.</p>
                </div>
    
                <div class="card">
                    <a href="getproduct.php?movie_id=tt1024648"><img src="img/Argo.jpg" alt="Argo poster" height="400px" width="300px"></a>
                    <p class="card-text">Acting under the cover of a Hollywood producer scouting a location for a science fiction film, a CIA agent launches a dangerous operation to rescue six Americans in Tehran during the U.S. hostage crisis in Iran in 1980.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt1655442"><img src="img/Artist.jpg" alt="The Artist poster" height="400px" width="300px"></a>
                    <p class="card-text">A silent movie star meets a young dancer, but the arrival of talking pictures sends their careers in opposite directions.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt1504320"><img src="img/king_speech.jpg" alt="The King's Speech poster" height="400px" width="300px"></a>
                    <p class="card-text">The story of King George VI of the United Kingdom of Great Britain and Northern Ireland, his impromptu ascension to the throne and the speech therapist who helped the unsure monarch become worthy of it.</p>
                </div>
                
                <div class="card">
                    <a href="getproduct.php?movie_id=tt0887912"><img src="img/hurt.jpg" alt="The Hurt Locker poster" height="400px" width="300px"></a>
                    <p class="card-text">During the Iraq War, a Sergeant recently assigned to an army bomb squad is put at odds with his squad mates due to his maverick way of handling his work.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt1010048"><img src="img/Slumdog_Millionaire.jpg" alt="Slumdog Millionaire poster" height="400px" width="300px" alt="Spotlight poster"></a>
                    <p class="card-text">A Mumbai teen reflects on his upbringing in the slums when he is accused of cheating on the Indian Version of "Who Wants to be a Millionaire?"</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt0477348"><img src="img/NoCountryforOldMen.jpg" alt="No Country for Old Men poster" height="400px" width="300px"></a>
                    <p class="card-text">Violence and mayhem ensue after a hunter stumbles upon a drug deal gone wrong and more than two million dollars in cash near the Rio Grande.</p>
                </div>
    
                <div class="card">
                    <a href="getproduct.php?movie_id=tt0407887"><img src="img/TheDeparted.jpg" alt="The Departed poster" height="400px" width="300px"></a>
                    <p class="card-text">An undercover cop and a mole in the police attempt to identify each other while infiltrating an Irish gang in South Boston.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt0375679"><img src="img/crash.jpg" alt="Crash poster" height="400px" width="300px"></a>
                    <p class="card-text">Los Angeles citizens with vastly separate lives collide in interweaving stories of race, loss and redemption.</p>
                </div>
                <div class="card">
                    <a href="getproduct.php?movie_id=tt0405159"><img src="img/baby.jpg" alt="Million Dollar Baby poster" height="400px" width="300px"></a>
                    <p class="card-text">A determined woman works with a hardened boxing trainer to become a professional.</p>
                </div>
            </div>
    
        </div>
    </div>
    
<?php require_once "footer.php"; ?>
