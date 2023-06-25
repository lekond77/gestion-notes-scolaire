
<header>

  <div class="w3-bar w3-black header-content">

    <?= $btnDisplaySemesters; ?>
    <div class="w3-dropdown-hover w3-mobile profil">

      <button class="w3-button"><?= isset($_SESSION['user']) ?  $_SESSION['user']['user']->getLastName()[0] . ' ' . $_SESSION['user']['user']->getFirstName()[0] : '' ?><i class="fa fa-caret-down"></i></button>
      <div class="w3-dropdown-content w3-bar-block w3-dark-grey">
        <a href="#" class="w3-bar-item w3-button w3-mobile"><i class="fa fa-user"></i> &ensp; Profile</a>
        <button class="w3-bar-item w3-button w3-mobile logout"><i class="fa fa-sign-out"></i> &ensp; Déconnection</button>
      </div>
    </div>

  </div>

</header>
