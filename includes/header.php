<style>
    html {
  scroll-behavior: smooth;
}

    
</style>
 <!--============= ScrollToTop Section Starts Here =============-->
    <!--div class="overlayer" id="overlayer">
        <div class="loader">
            <div class="loader-inner"></div>
        </div>
    </div>
    <a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
    <div class="overlay"></div-->
    <!--============= ScrollToTop Section Ends Here =============-->


    <!--============= Header Section Starts Here =============-->
    <header>
         
        <div class="header-bottom">
            <div class="container">
                <div class="header-wrapper">
                    <div class="logo">
                        <a href="index.php">
                            <img src="assets/images/logo/logo.png" alt="logo">
                        </a>
                    </div>
                    <ul class="menu ml-auto">
                        <li>
                            <a href="#0">Home</a>
                            <ul class="submenu">
                                <li>
                                    <a href="index.php">Home Page One</a>
                                </li>
                                <li>
                                    <a href="index-2.html">Home Page Two</a>
                                </li>
                                <li>
                                    <a href="index-3.html">Home Page Three</a>
                                </li>
                                <li>
                                    <a href="index-4.html">Home Page Four</a>
                                </li>
                                <li>
                                    <a href="index-5.html">Home Page Five</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="product.html">Auction</a>
                        </li>
                        <li>
                            <a href="#0">Pages</a>
                            <ul class="submenu">
                                <li>
                                    <a href="#0">Product</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="product.html">Product Page 1</a>
                                        </li>
                                        <li>
                                            <a href="product-2.html">Product Page 2</a>
                                        </li>
                                        <li>
                                            <a href="product-details.html">Product Details</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#0">My Account</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="sign-up.html">Sign Up</a>
                                        </li>
                                        <li>
                                            <a href="sign-in.html">Sign In</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#0">Dashboard</a>
                                    <ul class="submenu">
                                        <li>
                                            <a href="dashboard.html">Dashboard</a>
                                        </li>
                                        <li>
                                            <a href="profile.html">Personal Profile</a>
                                        </li>
                                        <li>
                                            <a href="my-bid.html">My Bids</a>
                                        </li>
                                        <li>
                                            <a href="winning-bids.html">Winning Bids</a>
                                        </li>
                                        <li>
                                            <a href="notifications.html">My Alert</a>
                                        </li>
                                        <li>
                                            <a href="my-favorites.html">My Favorites</a>
                                        </li>
                                        <li>
                                            <a href="referral.html">Referrals</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="about.html">About Us</a>
                                </li>
                                <li>
                                    <a href="faqs.html">Faqs</a>
                                </li>
                                <li>
                                    <a href="error.html">404 Error</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="token.php">Token</a>
                        </li>
                        <li>
                            <form class="search-form">
                                <input type="text" placeholder="Search for brand, model....">
                                <button type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </li>
                        <li class="menu ml-auto" style="color : white ; padding-left: 20px ; ">
                             <?php if (isset($_SESSION["username"])) { ?>
                               <a href="#0"><span style="font-size: 18px ;  "><?php echo $_SESSION["prenom"].", ".$_SESSION["budget"]." Token" ;  ?></span></a> 
                               

                               <ul class="submenu">
                                   <li>
                                       <a href="profile.php">Profil</a>
                                   </li>
                                   <li>
                                       <a href="logout.php">Se Déconnecter</a>
                                   </li>
                               </ul>
                            <?php
                            } else {  ?> 
                                <a href="sign-in.php">Se Connecter</a>

                            <?php } ?>
                        </li>
                    </ul>
                    
                    <div class="search-bar d-md-none">
                        <a href="#0"><i class="fas fa-search"></i></a>
                    </div>
                     
                     
                    <div class="header-bar d-lg-none">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--============= Header Section Ends Here =============-->