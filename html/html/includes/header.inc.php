<?php
         if(!isset($_SESSION['username'])) {
             header("Location: ../../index.html?error=invalidsession");
             exit();
         }

         $user = $_SESSION['username'];
         ?>
      <!-- START NAV -->
      <nav class="navbar is-white mb-5" style="box-shadow: 5px 10px 8px #888888">
         <div class="container">
            <div class="navbar-brand">
               <a class="navbar-item brand-text is-bold is-medium is-family-monospace"" href="../../index.html">
                PlaySpontaneous
               </a>
               <div class="navbar-burger burger" data-target="navMenu">
                  <span></span>
                  <span></span>
                  <span></span>
               </div>
            </div>
            <div id="navMenu" class="navbar-menu">
               <div class="navbar-end">
                  <div class="tabs is-right"> 
                     <a class="navbar-item is-medium is-family-monospace">
                     <?php
                        echo $_SESSION['username'];
                     ?>
                     </a>
                     <a class="navbar-item">
                     <?php
                        echo '<form action="../includes/logout.inc.php" method="POST">
                                 <button type="submit" name=logout-submit">Logout</button>
                              </form>';
                     ?>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </nav>
      <script type="text/javascript">
                    (function(){
                        var burger = document.querySelector('.burger');
                        var nav = document.querySelector('#' + burger.dataset.target);

                        burger.addEventListener('click', function() {
                            burger.classList.toggle('is-active');
                            nav.classList.toggle('is-active');
                        })
                    })();
      </script>