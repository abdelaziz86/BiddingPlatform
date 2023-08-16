<div class="col-sm-10 col-md-7 col-lg-4">
                    <div class="dashboard-widget mb-30 mb-lg-0 sticky-menu">
                        <div class="user">
                            <div class="thumb-area">


                                <form action="" method="POST"> 
                                    <div class="thumb">
                                        <a href="modifier.php?pdp_user=1">
                                            <?php echo '<img src="data:image;base64,'.base64_encode($_SESSION['pdp_user']).'" alt="Image" >'  ?>
                                             
                                        </a>
                                        
                                    </div>
                                    <label for="profile-pic" class="profile-pic-edit"><i class="flaticon-pencil"></i></label>
                                    <input  name="save_pdp" id="profile-pic" class="d-none"> 
                                </form>


                            </div>
                            <div class="content">
                                <h5 class="title"><a href="#0"><?php echo $_SESSION["username"] ;  ?></a></h5>
                                 
                            </div>
                        </div>
                        <ul class="dashboard-menu">
                            <?php if ($_SESSION["header_profile"]=="dashboard") { ?>
                                <li>
                                    <a href="dashboard.php" class="active" ><i class="flaticon-dashboard"></i>Tableau de Bord</a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="dashboard.php"><i class="flaticon-dashboard"></i>Tableau de Bord</a>
                                </li>

                            <?php }


                                if ($_SESSION["header_profile"]=="configuration") { ?> 
                                <li>
                                    <a href="profile.php" class="active" ><i class="flaticon-settings"></i>Configuration </a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="profile.php" ><i class="flaticon-settings"></i>Configuration </a>
                                </li>
 
                            <?php } 

                                if ($_SESSION["header_profile"]=="encheres") { ?> 
                                <li>
                                    <a href="my-bid.php" class="active"><i class="flaticon-auction"></i>Mes Enchères</a>
                                </li>
                            <?php } else { ?>
                                <li>
                                    <a href="my-bid.php"><i class="flaticon-auction"></i>Mes Enchères</a>
                                </li>

                            <?php } ?>

                            

                            <li>
                                <a href="winning-bids.html"><i class="flaticon-best-seller"></i>Enchères Gagnantes</a>
                            </li>
                            <li>
                                <a href="notifications.html"><i class="flaticon-alarm"></i>My Alerts</a>
                            </li>
                            <li>
                                <a href="my-favorites.html"><i class="flaticon-star"></i>My Favorites</a>
                            </li>

                            <?php if ($_SESSION["header_profile"]=="referrals") {    ?>
                            <li>
                                <a href="referral.php" class="active"><i class="flaticon-shake-hand"></i>Parrainage</a>
                            </li>
                            <?php } else  { ?>
                            <li>
                                <a href="referral.php"><i class="flaticon-shake-hand"></i>Parrainage</a>
                            </li>

                            <?php } ?>
                        </ul>
                    </div>
                </div>