 <!-- container section start -->
  <section id="container" class="">
     
      
      <header class="header dark-bg">
            <div class="toggle-nav">
                <div class="icon-reorder tooltips" data-original-title="" data-placement="bottom"><i class="icon_menu"></i></div>
            </div>

            <!--logo start-->
            <?php if($_SESSION['role'] == 1):?>
            <a href="<?php echo URLROOT;?>" class="logo" style="margin-top: 4px;"><img data-src="" class="img-responsive" style="width: 130px; height: 55px; border-top-left-radius: 5px; border-top-right-radius: 5px;" src="<?php echo URLROOT;?>/NiceAdmin/img/b7d2ed25-27a5-45c3-80de-ca4cb318d31a.jpg" alt="..."/></a>
            <?php elseif($_SESSION['role'] == 2):?>
                <a href="<?php echo URLROOT;?>" class="logo" style="margin-top: 4px;"><img data-src="" class="img-responsive" style="width: 130px; height: 55px; border-top-left-radius: 7px; border-top-right-radius: 7px;" src="<?php echo URLROOT;?>/NiceAdmin/img/b7d2ed25-27a5-45c3-80de-ca4cb318d31a.jpg" alt="..."/></a>
            <?php endif; ?>
            <!--logo end-->


            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="">
                            <!-- <span class="profile-ava">
                                <img alt="" src="img/avatar1_small.jpg">
                            </span> -->
                        <?php if($_SESSION['role'] == 1):?>
                            <span class="username"><?php echo $_SESSION['surname'] .' '. $_SESSION['firstname'];?></span>
                        <?php elseif($_SESSION['role'] == 2):?>
                            <span class="username"><?php echo $_SESSION['surname'] .' '. $_SESSION['firstname'];?></span>
                        <?php endif;?>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li class="eborder-top">
                                <a href="<?php echo URLROOT;?>/users/profile/<?php echo $_SESSION['user_id'];?>"><i class="icon_profile"></i> My Profile</a>
                            </li>
                            <li>
                                <a href="<?php echo URLROOT;?>/users/logout"><i class="icon_key_alt"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->