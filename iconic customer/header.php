<header id="header-section" class="header-section sticky-header-section not-stuck clearfix">
    <!-- header-bottom - start -->
    <div class="header-bottom">
        <div class="container">
            <div class="row">

                <!-- site-logo-wrapper - start -->
                <div class="col-lg-3">
                    <div class="site-logo-wrapper">
                        <a href="index-1.php" class="logo">
                            <img src="assets/images/iconicWlogo.png" alt="logo_not_found">
                        </a>
                    </div>
                </div>
                <!-- site-logo-wrapper - end -->

                <!-- mainmenu-wrapper - start -->
                <div class="col-lg-9">
                    <div class="mainmenu-wrapper">
                        <div class="row">

                            <!-- menu-item-list - start -->
                            <div class="col-lg-10">
                                <div class="menu-item-list ul-li clearfix">
                                    <ul>
                                        <!-- VENUES -->
                                        <li class="menu-item-has-children">
                                            <a href="./venues.php">Venues</a>
                                            <ul class="sub-menu">
                                                <li class="menu-item-has-children">
                                                    <a href='#' class="active">By Type</a>
                                                    <ul class="sub-menu">
                                                        <?php
                                                        $sql = "SELECT * FROM venue_type";
                                                        $rs = $conn->query($sql);
                                                        if ($rs->num_rows > 0) {
                                                            while ($row = $rs->fetch_assoc()) { 
                                                                echo sprintf("<li>
                                                                <a href='./venues.php?t=%s'>%s</a>
                                                            </li>", $row['type_id'], $row['type_name']);                                                                
                                                            }
                                                        }   
                                                        echo "<li>
                                                            <a href='./venues.php'>All</a>
                                                        </li>";
                                                        ?>
                                                    </ul>
                                                </li>
                                                <li class="menu-item-has-children">
                                                    <a href='#'>By City</a>
                                                    <ul class="sub-menu">
                                                        <?php
                                                        $sql = "SELECT city_id, city_name FROM city_master LIMIT 7";
                                                        $rs = $conn->query($sql);
                                                        if ($rs->num_rows > 0) {
                                                            while ($row = $rs->fetch_assoc()) { 
                                                                echo sprintf("<li>
                                                                <a href='./venues.php?c=%s'>%s</a>
                                                            </li>", $row['city_id'], $row['city_name']);                                                                
                                                            }
                                                        }
                                                        echo "<li>
                                                                <a href='./venues.php'>More</a>
                                                            </li>";   
                                                        ?>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- VENDORS START-->
                                        <li class="menu-item-has-children">
                                            <a href="#!">Vendors</a>
                                            <ul class="sub-menu">
                                                <li><a href="./vendors.php?t=C">Caterer</a></li>
                                                <li><a href="./vendors.php?t=M">Musician</a></li>
                                                <li><a href="./vendors.php?t=P">Photographer</a></li>
                                            </ul>
                                        </li>
                                        <!-- -------- -->
                                        <li class="menu-item-has-children">
                                            <a href="#!">events</a>
                                            <ul class="sub-menu">
                                                <?php
                                                $fetchEvents = "SELECT * FROM event_type";
                                                $rsEvent = $conn->query($fetchEvents);
                                                if ($rsEvent->num_rows > 0) {
                                                    while ($eventRow = $rsEvent->fetch_assoc()) {
                                                        echo sprintf("<li><a href='#?e=%s'>%s</a></li>",
                                                            $eventRow['event_type_id'], $eventRow['event_name']);
                                                    }
                                                }
                                                ?>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="blog.php">blogs</a>

                                        </li>
                                        <li>
                                            <a href="gallery.php">gallery</a>
                                        </li>
                                        <li class="menu-item-has-children">
                                            <a href="#!">contact</a>
                                            <ul class="sub-menu">
                                                <li><a href="contact.php">contact us</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- menu-item-list - end -->

                            <!-- menu-item-list - start -->
                            <div class="col-lg-2">
                                <div class="menu-item-list ul-li clearfix">
                                    <ul>
                                        <li class="menu-item-has-children">
                                            <a href="">
                                                <i class="fas fa-user"></i>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="profile.php">Profile</a></li>
                                                <li><a href='logout.php'>Logout</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li>
                                            <button type="button" class="toggle-overlay search-btn">
                                                <i class="fas fa-search"></i>
                                            </button>

                                            <div class="search-body">
                                                <div class="search-form">
                                                    <form action="#">
                                                        <input class="search-input" type="search" placeholder="Search Here">
                                                        <div class="outer-close toggle-overlay">
                                                            <button type="button" class="search-close">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </li> -->
                                    </ul>
                                </div>
                            </div>
                            <!-- menu-item-list - end -->

                        </div>
                    </div>
                </div>
                <!-- mainmenu-wrapper - end -->

            </div>
        </div>
    </div>
    <!-- header-bottom - end -->
</header>

<?php
if ($session->get("userId") != null) {
    $sql = "SELECT CONCAT(first_name, ' ', last_name) AS full_name FROM user WHERE user_id = ".$session->get("userId");
    $rsUser = $conn->query($sql);
    echo "Welcome, " . $rsUser->fetch_array()[0];
}
?>