<?php

class home {
  private $model;
  private $tweet;
  public function __construct () {
    require("model/timelineModel.php");
    require("model/profileModel.php");
    $this->model = new timeline ();
    $this->tweet = new user_profile();
  }

  public function home() {
    if (isset($_SESSION["login"])) {
      if (isset($_POST['add_tweet'])) {
        $tweet_bool = $this->tweet->add_tweet($_POST);
        if ($tweet_bool) {
          echo "tweet publié";
        }
        else {
          echo "tweet trop grand";
        }
      }
      $tab_follower = $this->model->get_my_follower();
      foreach ($tab_follower as $key => $value) {
        $tab_follower[$key] = $this->model->get_user_tweet($value);
        $rt = $this->tweet->get_user_rt($value);
        for ($i=0; $i < count($rt); $i++) {
          if (isset($rt[$i]["login"])) {
            $rt[$i]['login_init'] =
            $this->tweet->id_to_pseudo($rt[$i]['id_user'])['login'];
          }
        }
        $tab_follower[$key] = array_merge($tab_follower[$key], $rt);
      }
      $tab_follower = $this->model->sort_timeline($tab_follower);
      for ($i=0; $i < count($tab_follower); $i++) {
        $id_tweet = $tab_follower[$i]["id_tweet"];
        $tab_follower[$i]['content'] =
            htmlspecialchars($tab_follower[$i]['content']);
        $user;
        preg_match_all("#@([a-zA-Z0-9_-]+)#", $tab_follower[$i]['content'],
            $user);

        foreach ($user[1] as $key => $value) {
          $check = $this->model->user_is_in_db($value);
          if ($check && !preg_match("#>@(".$value."+)#",
                  $tab_follower[$i]['content'])) {
            $tab_follower[$i]['content'] = preg_replace("#@(".$value.")#",
                "<a href='/".DIRNAME."/profile/user/$1'>@$1</a>",
                $tab_follower[$i]['content']);
          }
        }
        $tab_follower[$i]["nb_tweet"] = $this->tweet->get_nb_like($id_tweet);
        $tab_follower[$i]["nb_rt"] =
            $this->tweet->get_nb_rt($tab_follower[$i]["id_tweet"]);
      }


      $trend = $this->model->get_trend();
      include ("view/home/timeline.php");
    }
  }

  public function tag ($tag = null) {
    if ($tag === null && isset($_POST['search']))
      $tag = $_POST['tag'];
    if (isset($_SESSION["login"])) {
      if (isset($_POST['add_tweet'])) {
        $tweet_bool = $this->tweet->add_tweet($_POST);
        if ($tweet_bool) {
          echo "tweet publié";
        }
        else {
          echo "tweet trop grand";
        }
      }
      $tab_follower = $this->model->get_tweet_with_tag($tag);
      $account_tag = $this->model->get_profile_with_tag($tag);
      for ($i=0; $i < count($tab_follower); $i++) {
        $id_tweet = $tab_follower[$i]["id_tweet"];
        $tab_follower[$i]["nb_tweet"] = $this->tweet->get_nb_like($id_tweet);
      }
      $trend = $this->model->get_trend();
      include ("view/home/tag_timeline.php");
    }
  }


  public function connexion () {
    header("Location: /account/login");
  }

    public function users() {
    $users = $this->model->get_users();
    foreach ($users as $key => $value) {
      
      echo "@".$value['login']." / ";
    }
  }

  public function ajax_timeline() {
    $tab_follower = $this->model->get_my_follower();
    foreach ($tab_follower as $key => $value) {
      $tab_follower[$key] = $this->model->get_user_tweet($value);
      $rt = $this->tweet->get_user_rt($value);
      for ($i=0; $i < count($rt); $i++) {
          if (isset($rt[$i]["login"])) {
            $rt[$i]['login_init'] =
            $this->tweet->id_to_pseudo($rt[$i]['id_user'])['login'];
          }
        }
        $tab_follower[$key] = array_merge($tab_follower[$key], $rt);
    }
    $tab_follower = $this->model->sort_timeline($tab_follower);
    for ($i=0; $i < count($tab_follower); $i++) {
      $id_tweet = $tab_follower[$i]["id_tweet"];
      $tab_follower[$i]['content'] =
          htmlspecialchars($tab_follower[$i]['content']);
      $user;
      preg_match_all("#@([a-zA-Z0-9_-]+)#", $tab_follower[$i]['content'],
          $user);

      foreach ($user[1] as $key => $value) {
        $check = $this->model->user_is_in_db($value);
        if ($check && !preg_match("#>@(".$value."+)#",
                $tab_follower[$i]['content'])) {
          $tab_follower[$i]['content'] = preg_replace("#@(".$value.")#",
              "<a href='/".DIRNAME."/profile/user/$1'>@$1</a>",
              $tab_follower[$i]['content']);
        }
      }
      $tab_follower[$i]["nb_tweet"] = $this->tweet->get_nb_like($id_tweet);
      $tab_follower[$i]["nb_rt"] =
          $this->tweet->get_nb_rt($tab_follower[$i]["id_tweet"]);
    }
    include ("view/home/timeline_ajax.php");

  }
}
