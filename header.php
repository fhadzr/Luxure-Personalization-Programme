<?php
echo '    <div class="promo-strip">';
echo '      <div class="scroll-text">';
echo '        <b> Website belum jadi sabar dulu yaaa :)</b>';
echo '      </div>';
echo '    </div>';
echo '    <div class="nav-bar">';
echo '      <div class="nav-bar-left">';
echo '        <a href="index.php" class="NaviProducts"><img src="images/banners/Logo-2.png" alt="logo" height="80"> </a>';
echo '      </div>';
echo '      <div class="nav-bar-center">';
echo '       <div class="nav-bar-item">';
echo '         <a href="new.php">NEW</a>';
echo '       </div>';
echo '       <div class="nav-bar-item">';
echo '         <a href="women.php">WOMEN</a>';
echo '       </div>';
echo '       <div class="nav-bar-item">';
echo '         <a href="men.php">MEN</a>';
echo '       </div>';
echo '      </div>';
echo '      <div class="nav-bar-right">';

if (isset($_SESSION['valid_user'])) {
  echo '      <a href="logout.php">';
  echo '      <img src="images/nav-bar-icons/logout.png" alt="Log Out" width="18">';
  echo '      </a>';
}
else {
  echo '      <a href="login.php">';
  echo '      <img src="images/nav-bar-icons/enter.png" alt="Log In" width="18">';
  echo '      </a>';
}

echo '        <a href="cart.php"><img src="images/nav-bar-icons/shopping-cart.png" alt="Cart" width="18"></a>';
echo '      </div>';
echo '    </div>';

 ?>
