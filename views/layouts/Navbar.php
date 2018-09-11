<?php
namespace Views\layouts;
class navbar
{
    function menilogin()
    {
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php?opcija=Home">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?opcija=Search">Pretraga clanova</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">
                            <form action="index.php?opcija=logout" method="post">
                                <input type="submit" name="submit" class="btn btn-link" value="Odjava">
                            </form>

                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <?php
    }

    function menilogout()
    {
        ?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?opcija=register">Registracija</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="index.php?opcija=login">Prijava</a>
                    </li>
                </ul>
            </div>
        </nav>
        <?php
    }
}