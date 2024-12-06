<nav class="navbar navbar-expand-lg  static-top">
    <div class="container">
        <a class="navbar-brand" href="../index.php">RISHATECH CLIENT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user'])) { ?>
                    <li class="nav-item">
                        <form action="../app/formController.php" method="POST">
                            <button class="btn btn-outline-light my-2 my-sm-0" type="submit" name="ClientLogout">Logout</button>
                        </form>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
