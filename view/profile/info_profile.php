<?php require(ROOT . '/view/header.php');?>
<div class="container">
<div class="row">
  <div class="col-xs-12 cover_picture vert-offset-bottom-2">
    <?php
    if (file_exists(ROOT . "/misc/" . $profile_data['login'] . "_cover.jpg")) {
      echo '<img src="/' .DIRNAME .'/misc/'. $profile_data['login']
      .'_cover.jpg" alt="profil" class="cover"/>';
    }
    else {
      // echo '<img src="/' .DIRNAME .'/misc/default_profile.png" alt="profil"
      //class="cover"/>';
    }
    ?>
  </div>
  <!-- </div> -->
  <!-- <div class="row"> -->
  <div class="col-xs-3 info">
    <div class="info-presentation vert-offset-top-1">
      <?php
      if (file_exists(ROOT . "/misc/" . $profile_data['login'] .
        "_profile.jpg")) {
        echo '<img src="/' .DIRNAME .'/misc/'. $profile_data['login'] .
      '_profile.jpg" alt="profil" class="img-thumbnail"/>';
    }
    else {
      echo '<img src="/' .DIRNAME .'/misc/default_profile.png" alt="profil"
      class="img-thumbnail"/>';
    }
    
    ?>
    <h3><?php echo $profile_data['firstname'] . " " .
      $profile_data['name']?></h3>
      <h4>@<?php echo $profile_data['login']?></h4>
    </div>
    <p class="col-xs-offset-1">
      <u>adresse mail :</u> <?php echo $profile_data['mail'];?>
    </p>
    <p class="col-xs-offset-1">
      Description : <?php echo $profile_data['description'];?>
    </p>
    <form action="<?php echo '/'.DIRNAME.'/profile/user/'.
    $profile_data['login'];?>" method="post">
    <?php
    if (!$follow && $profile_data['login'] !== $_SESSION['login']){
      echo '<button type="submit" class="btn btn-primary follow-button"
      name="follow">Follow</button>';
    }
    else if ($follow  && $profile_data['login'] !== $_SESSION['login']){
      echo '<button type="submit" class="btn btn-default follow-button"
      name="unfollow">Unfollow</button>';
    }
    ?>
  </form>
  <hr>
  <form action="#" method="post">
    <textarea class="form-control profile-tweet" id="text-box" name="content">@<?php
      echo $profile_data['login'] . " ";?></textarea>
    <div class="col-xs-12 green" id="nbr">Charactere restant : 140</div>
      <button type="submit" name="add_tweet"
      class="btn btn-primary vert-offset-top-1 vert-offset-bottom-1 pull-right">
      Tweeter</button>
    </form>
  </div>
  <div class="col-xs-8 info col-xs-offset-1">
    <ul class="nav nav-tabs nav-justified">
      <li role="presentation" class="active"><a href="<?php echo '/'.
        DIRNAME.'/profile/user/'.$profile_data['login'];?>">Tweet</a></li>
        <li role="presentation"><a href="<?php echo '/'.
          DIRNAME.'/profile/followers/'.$profile_data['login'];?>">Followers</a>
        </li>
        <li role="presentation"><a href="<?php echo '/'.
          DIRNAME.'/profile/followings/'.$profile_data['login'];?>">Followings</a>
        </li>
        <li role="presentation"><a href="<?php echo '/'.
          DIRNAME.'/profile/like/'.$profile_data['login'];?>">Like</a></li>
        </ul>
