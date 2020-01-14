<!--nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#">SmartNotes</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Notes<span class="sr-only">(current)</span></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Best notekeeper out there<span class="sr-only">(current)</span></a>
      </li>
    </ul>

  </div>
</nav-->

<nav class="navbar navbar-expand-lg navbar-light sticky-top">
  <a class="navbar-brand" href="#">SmartNotes</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Notes<span class="sr-only">(current)</span></a>
      </li>
      <!--li class="nav-item">
        <a class="nav-link" href="#">Home</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li-->
    </ul>
    <?php
    if (count($_COOKIE) == 0) {
    	
    ?>
      <a href="log_in.php" style="margin-right: 15px;">
      	<button class="blue_hdr_btn" type="button">log in</button>
      </a>
      <a href="sign_up.php">
      	<button class="blue_hdr_btn1" type="button">sign up</button>
      </a>
    <?php
    }
    if (count($_COOKIE) > 0) {
     	
    ?>
    <ul class="navbar-nav ml-auto" style="margin-right: 5px; font-size: 16px;">
      <li class="nav-item active">
        <a class="nav-link"><?=$_COOKIE['login']?></a>
      </li>
     </ul>
    <form class="form-inline my-2 my-lg-0" method="POST">
    	<input type="hidden" name="logout">
    	<button class="blue_hdr_btn1" type="submit">log out</button>
    </form>
    <?php
    } 
    if (isset($_POST['logout'])) {
    	setcookie('id', 1, time() - 3600, "/");
		setcookie('login', 1, time() - 3600, "/");
		setcookie('email', 1, time() - 3600, "/");
		setcookie('pw', 1, time() - 3600, "/");
		setcookie('remember', 1, time() - 3600, "/");
		header('Location: homepage.php');
    }
    ?>
  </div>
</nav>
