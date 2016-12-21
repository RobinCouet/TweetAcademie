<?php

class timeline extends database {

  public function __construct () {
    parent::__construct();
  }

    public function get_users() {
    $req = $this->bdd->prepare("SELECT * FROM users where login 
    like '%' :users '%' limit 10");
    $req->execute(array('users'=>$_GET['user']));
    $users = $req->fetchAll(PDO::FETCH_ASSOC);
    return $users;
  }

  public function get_my_follower () {
    if (isset($_SESSION["id_user"])) {
      $req = $this->bdd->prepare("SELECT id_following FROM follow WHERE
        id_follower = :id_user");
      $req->execute(array('id_user' => $_SESSION["id_user"]));
      $data = $req->fetchAll(PDO::FETCH_ASSOC);

      for ($i = 0; $i < count($data);$i++) {
        $data[$i] = $data[$i]['id_following'];
      }
      // on rajoute ses propres tweet
        array_push($data, $_SESSION['id_user']);
        return $data;
      }
    }

    public function get_user_tweet($id_user) {
      $req = $this->bdd->prepare("SELECT * FROM tweets INNER JOIN users ON
        users.id_user = tweets.id_user WHERE tweets.id_user = :id_user ORDER BY
        id_tweet DESC;");
      $req->execute(array('id_user' => $id_user));
      $data = $req->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    public function sort_timeline($tab) {
      $my_tab = [];
      foreach ($tab as $key => $value) {
        $my_tab  = array_merge($my_tab, $tab[$key]);
      }
      usort($my_tab, function($case1, $case2) {
        if ($case1["created"] === $case2["created"])
          return 0;
        if (strtotime($case1["created"]) > strtotime($case2["created"]))
          return -1;
        if (strtotime($case1["created"]) < strtotime($case2["created"]))
          return 1;
      });
      return $my_tab;
    }
    public function get_tweet_with_tag($tag) {
      $req = $this->bdd->prepare("SELECT * FROM tweets
        INNER JOIN users ON users.id_user = tweets.id_user WHERE content
        LIKE :tag ORDER BY id_tweet DESC");
      $req->execute(array('tag' => "%#". $tag . "%"));
      $data = $req->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }

    public function get_profile_with_tag($tag) {
      $req = $this->bdd->prepare("SELECT login FROM users WHERE login LIKE
        :pseudo");
      $req->execute(array('pseudo' => "%". $tag . "%"));
      $data = $req->fetchAll(PDO::FETCH_ASSOC);
      return $data;
    }


    public function get_trend() {
      $req = $this->bdd->prepare("SELECT content FROM tweets
        WHERE content LIKE '%#%' LIMIT 10");
      $req->execute();
      $data = $req->fetchAll(PDO::FETCH_ASSOC);
      $tab = [];
      $result = [];
      for ($i = 0; $i < count($data); $i++) {
        preg_match_all("~#([a-zA-Z0-9]+)~", $data[$i]['content'], $tab[$i]);
      }
      for ($i = 0; $i < count($tab); $i++) {
        foreach ($tab[$i] as $key => $value) {
          array_push($result, $value);
        }
      }
      $tab = [];
      for ($i = 0; $i < count($result); $i++) {
        foreach ($result[$i] as $key => $value) {
          array_push($tab, $value);
        }
      }
      $result = [];
      for ($i = 0; $i < count($tab);$i++) {
        if (preg_match("~#~", $tab[$i])){
          array_push($result, $tab[$i]);
        }
      }
      $result = array_unique($result);
      return $result;
    }

    public function user_is_in_db($pseudo) {
      $req = $this->bdd->prepare("SELECT login FROM users 
      WHERE login = :login");
      $req->execute(array('login' => $pseudo));
      $data = $req->rowCount();
      if ($data === 1)
        return true;
      else
        return false;
    }
  }