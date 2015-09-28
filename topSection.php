<header id="main-header" class="clearfix">
<div class="inner">
  <h1 id="logo">
    <a href="<?php echo $homeURL;?>">
    <span class="hide">
      <?php echo $siteTitle;?>
    </span>
    <img src="<?php echo $siteDir;?>/assets/imgs/main-logo.svg" alt="Wilshire Capital" />
  </a>
  </h1>

  <a href="#" class="dt-hide touch-open">
    <svg>

<use xlink:href="#touc-menu" />
    </svg>

  </a>

  <nav id="mainNav">
    <ul class="no-style clearfix">
      <li class="profile">
        <a href="<?php echo $homeURL;?>/">
          Profile
        </a>
      </li>

      <li class="strategy">
        <a href="<?php echo $homeURL;?>/strategy">
          Strategy
        </a>
      </li>

      <li class="portfolio">
        <a href="<?php echo $homeURL;?>/portfolio">
          Portfolio
        </a>
      </li>

      <li class="team">
        <a href="<?php echo $homeURL;?>/team">
          Team
        </a>
      </li>

      <li class="contact">
        <a href="<?php echo $homeURL;?>/contact">
          Contact
        </a>
      </li>
      <?php
      if($mobile == false) {
        if(is_user_logged_in()) {
          $logoutURL = wp_logout_url( home_url());
          ?>
          <li class="investordashboard">
            <a class="no-history" href="<?php echo $homeURL;?>/investor-dashboard">
              Info
            </a>
          </li>
          <li class="logout">
            <a class="no-history" href="<?php echo $logoutURL;?>">
              Logout
            </a>
          </li>
          <?php
        } else {
          ?>
          <li class="login">
            <a class="no-history" href="<?php echo $homeURL;?>/wp-admin">
              Login
            </a>
          </li>

          <?php
        }
      }



      ?>


    </ul>
    <a href="#" class="touch-close dt-hide">
      <svg>
        <use xlink:href="#touch-close" />

      </svg>
    </a>
  </nav>


</div>
</header>
