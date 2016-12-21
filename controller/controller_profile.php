<?php

class profile {
  private $model;
  public function __construct() {
    require(ROOT . "/model/profileModel.php");
    $this->model = new user_profile();
  }

  public function home () {
    $data = $this->model->get_user_tweet($_SESSION["id_user"]);
    $profile_data = $this->model->get_user_profile($_SESSION["id_user"]);
    
    require (ROOT . "/view/profile/info_profile.php");
    require (ROOT . "/view/profile/default_profile.php");
  }

  public function user ($user_pseudo) {
    if (isset($_SESSION["id_user"])) {
    $id_user = $this->model->pseudo_to_id($user_pseudo);
    $id_user = $id_user['id_user'];
    if (isset($_POST['follow'])) {
      $this->model->follow_user($id_user);
    }
    if (isset($_POST['unfollow'])) {
      $this->model->unfollow_user($id_user);
    }
    $follow = $this->model->check_follow($id_user);
    if (isset($_POST["delete"]))
      $this->model->delete_tweet($_POST["delete"]);
    if (isset($_SESSION["login"])) {
      if (isset($_POST['add_tweet'])) {
        $tweet_bool = $this->model->add_tweet($_POST);
        if ($tweet_bool) {
          echo "tweet publié";
        }
        else {
          echo "tweet trop grand";
        }
      }
      $data = $this->model->get_user_tweet($id_user);
      $profile_data = $this->model->get_user_profile($id_user);
      for ($i=0; $i < count($data); $i++) {
        $data[$i]['content'] = htmlspecialchars($data[$i]['content']);
        $user;
        preg_match_all("#@([a-zA-Z0-9_-]+)#", $data[$i]['content'], $user);
        foreach ($user[1] as $key => $value) {
          $check = $this->model->user_is_in_db($value);
          if ($check && !preg_match("#>@(".$value."+)#",
            $data[$i]['content'])) {
            $data[$i]['content'] = preg_replace("#@(".$value."+)#",
              "<a href='/".DIRNAME."/profile/user/$1'>@$1</a> ",
              $data[$i]['content']);
          }
        }
        $id_tweet = $data[$i]["id_tweet"];
        $data[$i]["nb_tweet"] = $this->model->get_nb_like($id_tweet);
        $data[$i]["nb_rt"] = 
          $this->model->get_nb_rt($data[$i]["id_tweet"]);
      }      
      require (ROOT . "/view/profile/info_profile.php");
      require (ROOT . "/view/profile/default_profile.php");
    }
  }
  else
    header("Location: /Projet_Web_tweet_academie/account/login");
  }

  public function followers ($user_pseudo) {
    $id_user = $this->model->pseudo_to_id($user_pseudo);
    $id_user = $id_user['id_user'];
    $follow = $this->model->check_follow($id_user);
    $profile_data = $this->model->get_user_profile($id_user);
    $data = $this->model->get_user_follower($id_user);
    require (ROOT . "/view/profile/info_profile.php");
    require (ROOT . "/view/profile/followers_profile.php");
  }

  public function followings ($user_pseudo) {
    $id_user = $this->model->pseudo_to_id($user_pseudo);
    $id_user = $id_user['id_user'];
    $follow = $this->model->check_follow($id_user);
    $profile_data = $this->model->get_user_profile($id_user);
    $data = $this->model->get_user_following($id_user);
    require (ROOT . "/view/profile/info_profile.php");
    require (ROOT . "/view/profile/followings_profile.php");
  }

  public function like($login) {
    $id_user = $this->model->pseudo_to_id($login);
    $id_user = $id_user["id_user"];
    $follow = $this->model->check_follow($id_user);
    $profile_data = $this->model->get_user_like($id_user);
    if (count($profile_data) > 0) {
      for ($i=0; $i < count($profile_data); $i++) { 
        if (isset($profile_data[$i]["id_tweet"])) {
          $profile_data[$i]["nb_tweet"] = 
          $this->model->get_nb_like($profile_data[$i]["id_tweet"]);
          $profile_data[$i]["nb_rt"] = 
          $this->model->get_nb_rt($profile_data[$i]["id_tweet"]);
          $profile_data[$i]['content'] =
          htmlspecialchars($profile_data[$i]['content']);
          $user;
          preg_match_all("#@([a-zA-Z0-9_-]+)#", $profile_data[$i]['content'],
            $user);
          foreach ($user[1] as $key => $value) {
            $check = $this->model->user_is_in_db($value);
            if ($check && !preg_match("#>@(".$value."+)#",
            $profile_data[$i]['content'])) {
              $profile_data[$i]['content'] = preg_replace("#@(".$value."+)#",
                "<a href='/".DIRNAME."/profile/user/$1'>@$1</a> ",
                $profile_data[$i]['content']);
            }
          }
        }
      }
      $data = $this->model->get_user_profile($id_user);
      $profile_data["login"] = $data["login"];
      $profile_data["mail"] = $data["mail"];
      $profile_data["firstname"] = $data["firstname"];
      $profile_data["name"] = $data["name"];
      $profile_data["description"] = $data["description"];
    }
    else 
      $profile_data = $this->model->get_user_profile($id_user);

    require (ROOT . "/view/profile/info_profile.php");
    require (ROOT . "/view/profile/like_profile.php");
  }
  public function tweet_like($id_tweet) {
    $adresse = $_SERVER['HTTP_REFERER'];
    $this->model->like_tweet($id_tweet);
    header("location:" . $adresse);
  }
  public function retweet($id_tweet) {
    $adresse = $_SERVER['HTTP_REFERER'];
    $this->model->retweet_tweet($id_tweet);
    header("location:" . $adresse);
  }
}
