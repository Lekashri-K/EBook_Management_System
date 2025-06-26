<div style="background-color:#5d4037;height:15px;">

    </div>
    <div class="header">
        <style>
            .signin {
                background-color: green;
                margin: 5px;
                padding: 5px;
                color: white;
                height: 20px;
                margin-top: -5px;
                border-radius: 8%;
                text-decoration: none;
                display: inline-block;
                transition: transform 0.2s ease, filter 0.2s ease;
            }

            .signin:hover {

                transform: scale(1.05);
            }

            .login {
                background-color: darkblue;
                margin: 5px;
                padding: 5px;
                color: white;
                height: 20px;
                margin-top: -5px;
                border-radius: 8%;
                text-decoration: none;
                display: inline-block;
                transition: transform 0.2s ease, filter 0.2s ease;

            }

            .logout {
                background-color: #c9302c;
                margin: 5px;
                padding: 5px;
                color: white;
                height: 20px;
                margin-top: 10px;
                border-radius: 8%;
                text-decoration: none;
                transition: transform 0.2s ease, filter 0.2s ease;
            }

            .logout:hover {
                background-color: #c9302c;
                box-shadow: 0px 0px 10px rgba(217, 83, 79, 0.8);
            }

            .login:hover {

                transform: scale(1.05);
            }

            /* .go-button {
                margin-left: 10px;
                background-color: #144250;
                margin: 5px;
                padding: 10px;
                color: white;
                border-radius: 8%;
                height: 15px;
                transition: transform 0.2s ease, filter 0.2s ease;
                
            } */
            .go-button {
                background-color: #144250;
                border-color: #144250;
                font-size: 12px;
                padding: 8px;
                color: white;
                border-radius: 8%;
                height: 34px;
                transition: transform 0.2s ease, filter 0.2s ease;
                margin-top: 11px;
            }

            .go-button:hover {
                transform: scale(1.05);
                filter: brightness(1.1);
            }
        </style>


        <div class="nav">
            <div>
                <img src="logo.jpeg" alt="image not found" width="60px" height="60px" class="logo" ;>
                </img>
            </div>
            <div class="heading">
                <i><b>E Book Galaxy</b></i>
            </div>
            <!-- <div class="size">
                <div>
                    <input class="searchbar" placeholder="  Search by title name">

                </div>
                <div class="go">
                    <h5 class="go-button">Search</h5>
                </div>
            </div> -->
            <div class="size">

                <form method="POST" action="search.php" style="display: flex; ">
                    <input class="searchbar" name="search" placeholder="  Search by title name">
                    <button type="submit" class="go-button">Search</button>
                </form>
            </div>

            <div class="adjust">
                <style>
                    .profile_pic:hover {
                        transform: scale(1.05);
                    }
                </style>
                <?php
                if (!isset($_SESSION['name'])) {
                    $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
                } else {
                    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
                }
                ?>

                <?php if (isset($_SESSION['name'])) { ?>
                    <img src="profile.jpeg" id="logout-btn" class="profile_pic"
                        style="width:40px;height:30px;border-radius:60%;margin-top:15px;margin-right:10px;cursor:pointer" />
                    <h4><a href="logout.php" class="logout"><i class="fa-solid fa-user-plus fa-sm"
                                style="margin-right:5px"></i>Logout</a></h4>

                <?php } else { ?>
                    <h4><a href="login.php" class="login"><i class="fa-solid fa-user-plus fa-sm"
                                style="margin-right:5px"></i>Login</a></h4>
                    <h4><a href="register.php" class="signin"><i class="fa-solid fa-right-to-bracket fa-sm"
                                style="margin-right:5px"></i>Signup</a></h4>
                <?php } ?>

            </div>


        </div>

    </div>
    <div class="pages" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="items" style="display:flex">
            <h3>
                <a href="index.php" style="color:white; text-decoration: none; margin-right:20px">
                    <i class="fa-solid fa-house-chimney fa-sm"
                        style="color:white;margin-right:8px;margin-left:5px"></i>Home</a>
            </h3>
            <!-- <h3 style="margin-right:15px"><i class="fa-solid fa-list fa-sm" style="color:white;margin-right:8px"></i>Categories</h3> -->
            <h3>
                <a href="index.php#category-image" style="color:white; text-decoration: none; margin-right:20px;">
                    <i class="fa-solid fa-list fa-sm" style="color:white;margin-right:8px;"></i>Categories</a>
            </h3>
            <h3>
                <a href="about.php" style="color:white; text-decoration: none; margin-right:20px">
                    <i class="fa-solid fa-address-card fa-sm" style="color:white;margin-right:8px"></i>About Us</a>
            </h3>
            <h3>
                <a href="review.php" style="color:white; text-decoration: none; margin-right:20px"><i
                        class="fa-solid fa-magnifying-glass fa-sm" style="color:white;margin-right:8px"></i>Reviews</a>
            </h3>

        </div>
        <div class="contact" style="display:flex;margin-right:10px">
            <h4><i class="fa-solid fa-person-circle-question" style="color:black;margin-right:5px"></i><a
                    href="help.php">Q&A Spot</a></h4>
            <h4><i class="fa-solid fa-user-tie" style="color:black;margin-right:5px"></i><a href="contact.php">Contact
                    Us</a></h4>
        </div>
    </div>
