<!DOCTYPE html>
<!-- Login Page | Allows the user to either login or create an account -->
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Play Spontaneous</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.0/css/bulma.min.css" />
    <link rel="stylesheet" type="text/css" href="../css/neumorphic-login.css">
  </head>

  <body>
    <section class="container">
      <div class="hero-body has-text-centered">
        <div class="login">
            <a class="title is-bold is-medium is-size-3 is-family-monospace"" href="../index.html">
                PlaySpontaneous
            </a>
            <?php
            if(isset($_GET['error']))
            {
              if($_GET['error'] == "incorrectpassword") {
                echo '<div class="notification is-danger"> Password is incorrect</div>';
              }
              else if($_GET['error'] == "emptyfields") {
                echo '<div class="notification is-danger"> Please Fill in all Fields!</div>';
              }
              else if($_GET['error'] == "nouserfound") {
                echo '<div class="notification is-danger">No User Found</div>';
              }
            }
          ?>
            <p class="mt-5"></p>
          <form action="includes/login.inc.php" method="POST">
            <div class="columns is-vcentered is-multiline is-mobile">
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Username
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="user" class="input is-medium is-rounded" type="text" placeholder="Username" autocomplete="username" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Password
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="pwd" class="input is-medium is-rounded" type="password" placeholder="Password" autocomplete="current-password" required />
                </div>
              </div>
              <br />
            </div>
            <button name="login-submit" class="button is-block is-fullwidth is-primary is-medium is-rounded has-background-info" type="submit">
              Login
            </button>
          </form>
          <br>
          <nav class="level">
            <div class="level-item has-text-centered">
              <div>
                <a href="#">Forgot Password?</a>
              </div>
            </div>
            <div class="level-item has-text-centered">
              <div>
                <a href="createAccount.php">Create an Account</a>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>
  </body>

</html>