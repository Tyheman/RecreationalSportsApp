<!DOCTYPE html>
<!-- Account Creation Page | Allows users to create an account -->
<html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account - Play Spontaneous</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
              if($_GET['error'] == "passwordsdontmatch") {
                echo '<div class="notification is-danger"> Your passwords didn\'t match</div>';
              }
              else if($_GET['error'] == "usernametooshort") {
                echo '<div class="notification is-danger"> Username must be at least 6 characters long</div>';
              }
              else if($_GET['error'] == "passwordrequirements") {
                echo '<div class="notification is-danger"> Password must contain One Lowercase, One Uppercase, One Digit, and One Special Character. 8-20 Characters in Length.</div>';
              }
              else if($_GET['error'] == "passwordtooshort") {
                echo '<div class="notification is-danger"> Password must be at least 8 characters long</div>';
              }
              else if($_GET['error'] == "invaildUsername") {
                echo '<div class="notification is-danger"> Username can only contain lowercase, uppercase, and numeric characters</div>';
              }
              else if($_GET['error'] == "invaildpassword") {
                echo '<div class="notification is-danger"> Password can only contain lowercase, uppercase, and numeric characters</div>';
              }
              else if($_GET['error'] == "emptyFields") {
                echo '<div class="notification is-danger"> Please Fill in all Fields</div>';
              }
              
            }
          ?>
        <p class="mt-5"></p>
          <form action="includes/signup.inc.php" method="POST">
            <div class="columns is-vcentered is-multiline is-mobile">
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Username
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="username" class="input is-medium is-rounded" type="text" placeholder="Enter Username" autocomplete="off" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Email
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="email" class="input is-medium is-rounded" type="email" placeholder="Enter Email" autocomplete="off" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  First Name
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="fname" class="input is-medium is-rounded" type="text" placeholder="Enter First Name" autocomplete="off" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Last Name
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="lname" class="input is-medium is-rounded" type="text" placeholder="Enter Last Name" autocomplete="off" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Date Of Birth
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="age" class="input is-medium is-rounded" type="date" placeholder="Enter Age" autocomplete="off" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Password
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="password" class="input is-medium is-rounded" type="password" placeholder="Enter Password" autocomplete="off" required />
                </div>
              </div>
              <div class="column is-one-fifth">
                <a class="title is-bold is-medium is-size-4 is-size-6-touch is-family-monospace">
                  Re-enter Password
                </a>
              </div>
              <div class="column is-four-fifths field">
                <div class="control">
                  <input name="password-repeat" class="input is-medium is-rounded" type="password" placeholder="Re-enter Password" autocomplete="off" required />
                </div>
              </div>
            </div>
            <br />
            <button name="signup-submit" class="button is-block is-fullwidth is-primary is-medium is-rounded has-background-info" type="submit">
              Create Account
            </button>
          </form>
          <br>
          <nav class="level">
            <div class="level-item">
              <div>
                <a href="login.php">Continue to Login Page  <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </section>
  </body>

</html>