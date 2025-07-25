<?php
require_once 'utils/functions.php';

if (!isset($showHeroSection)) {
    $showHeroSection = false;
}
?>
<header<?php if ($showHeroSection) echo ' class="bgImage"'; ?>>
    <nav class="navbar">
        <div class="container">
            <div class="navbar-header"><!--website name/title-->
                <?php 
                require_once 'utils/functions.php';
                echo '<a href = "index.php" class = "navbar-brand">
                    Event Management Systems
                </a> ';
                ?>
            </div>
            <ul class="nav navbar-nav navbar-right"><!--navigation-->
                <?php 
                //links to database contents. *if logged in
                if(is_logged_in()){
                    require_once 'utils/functions.php';
                    $user = $_SESSION['user'];
                    $role = $user->getRole();
                    $username = $user->getUsername();
                    echo '<li><a href = "index.php">Home</a></li>';
                    echo '<li><a href = "events_public.php">Events</a></li>';
                    echo '<li><a href = "locations.php">Locations</a></li>';
                    echo '<li><a href = "viewSponsor.php">Sponsors</a></li>';
                    echo '<li><a href = "contact.php">Contact Us</a></li>';
                    // User dropdown
                    echo '<li class="dropdown user-dropdown">';
                    echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding-top:8px;">';
                    echo '<span class="glyphicon glyphicon-user" style="font-size:20px;"></span> <span class="hidden-xs" style="font-weight:bold;"> '.htmlspecialchars($username).' </span> <span class="caret"></span>';
                    echo '</a>';
                    echo '<ul class="dropdown-menu">';
                    // Role-based options
                    if ($role === 'admin') {
                        echo '<li><a href="viewEvents.php" style="color:#ffffff;">Manage All Events</a></li>';
                        echo '<li><a href="viewLocations.php" style="color:#ffffff;">Manage Locations</a></li>';
                        echo '<li><a href="viewSponsor.php" style="color:#ffffff;">Manage Sponsors</a></li>';
                        echo '<li><a href="download_attendees.php" style="color:#ffffff;">Download Attendees</a></li>';
                    } elseif ($role === 'organizer') {
                        echo '<li><a href="viewEvents.php"style="color:#ffffff;">Manage My Events</a></li>';
                        echo '<li><a href="download_attendees.php"style="color:#ffffff;">Download Attendees</a></li>';
                    } else {
                        echo '<li><a href="viewEvents.php"style="color:#ffffff;">Browse Events</a></li>';
                    }
                    echo '<li role="separator" class="divider"></li>';
                    echo '<li><a href="logout.php" style="color:#e74c3c;"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
                    echo '</ul>';
                    echo '</li>';
                }  
                //links non database contents. *if logged out
                else {
                    echo '<li><a href = "index.php">Home</a></li>';
                    echo '<li><a href = "events_public.php">Events</a></li>';
                    echo '<li><a href = "locations2.php">Locations</a></li>';
                    echo '<li><a href = "viewSponsor.php">Sponsors</a></li>';
                    echo '<li><a href = "contact.php">Contact Us</a></li>';
                    echo '<button type = "button" class = "btn btn-default navbar-btn" data-toggle = "modal" data-target = "#login">Login <Span class="glyphicon glyphicon-log-in"></span></button>';
                }
                ?>
            </ul>
        </div><!--container div-->
    </nav>
    <!-- Login Modal moved outside nav and ul for proper HTML structure -->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><!--modal for login-->
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header"><!--modal header-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Login</h4><!--modal title-->
                </div>
                <div class="row">
                    <div class="modal-body"><!--modal content-->
                        <div class ="col-md-6 col-md-offset-3">
                            <form action="login.php" method="POST">
                                <div class = "form-group"><!--username-->
                                    <label for="username">Username:</label>
                                    <input type="text"
                                           name="username"
                                           class="form-control"
                                           value="<?php if (isset($formdata['username'])) echo $formdata['username']; ?>"
                                           />
                                    <span class="error"><!--error message on failed input-->
                                        <?php if (isset($errors['username'])) echo $errors['username']; ?>
                                    </span>
                                </div>
                                <div class="form-group"><!--password-->
                                    <label for="password">Password:</label>
                                    <input type="password"
                                           name="password"
                                           class="form-control"
                                           value=""
                                           />
                                    <span class="error"><!--error message on failed input-->
                                        <?php if (isset($errors['password'])) echo $errors['password']; ?>
                                    </span>
                                </div>
                                <button type="submit" class = "btn btn-default loginbtn">Login</button><!--login button-->
                                <a class="btn btn-default navbar-btn rgsterbtn" href = "register_form.php">Register</a><!--register button-->
                            </form>
                        </div>
                    </div><!--modal body div-->
                </div><!--row div-->
                <div class="modal-footer"><!--modal footer-->
                <button type="button" class="btn btn-default closebtn" data-dismiss="modal">Close</button><p><!--close button-->
                </div><!--modal footer div-->
            </div><!--modal content div-->
        </div><!--modal dialog div-->
    </div><!--modal div-->
    <?php if ($showHeroSection): ?>
    <div class = "col-md-12">
        <div class = "container">
            <div class = "jumbotron text-center"><!--jumbotron-->
                <h1 class="mb-3" style="font-weight:bold;">
                  <span style="display:block;font-weight:bold;">Discover &amp; Promote</span>
                  <span style="display:block;font-weight:bold;">Upcoming Event</span>
                </h1>
                <p class="lead" style="max-width:600px;margin:0 auto 20px auto;">
                  Our platform streamlines the process of organizing, managing, and promoting all types of events—professional conferences, educational seminars, workshops, social gatherings, and more.<br>
                  <span style="font-size:1.1em;">Enjoy comprehensive tools for event creation, scheduling, registration, attendee management, and feedback collection.</span>
                </p>
            </div>
        </div>
    </div>
    <?php endif; ?>
</header>