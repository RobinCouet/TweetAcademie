<?php

class user_profile extends database{
  public function __construct () {
    parent::__construct();

  }

  public function get_user_tweet($id_user) {
    $req = $this->bdd->prepare("SELECT * FROM tweets INNER JOIN users ON 
      users.id_user = tweets.id_user WHERE users.id_user= :id_user ORDER BY 
      id_tweet DESC");
    $req->execute(array('id_user' => $id_user));
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function check_follow($id_user) {
    $req = $this->bdd->prepare("SELECT * FROM follow WHERE
      id_follower=:session AND id_following=:id_user");
    $req->execute(array(
      'session' => $_SESSION['id_user'],
      'id_user' => $id_user
      ));
    $count = $req->rowCount();
    if ($count === 1)
      return true;
    else
      return false;
  }

  public function get_user_profile($id_user) {
    $req = $this->bdd->prepare(" SELECT users.*, user_infos.*, 
      profiles.description FROM users INNER JOIN user_infos ON 
      user_infos.id_user = users.id_user INNER JOIN profiles ON
      profiles.id_profile = users.id_profile WHERE 
      users.id_user = :id_user");
    $req->execute(array('id_user' => $id_user));
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function get_user_follower($id_user) {
    $req = $this->bdd->prepare("SELECT login FROM follow INNER JOIN users
      ON users.id_user = follow.id_follower WHERE id_following = :id_user");
    $req->execute(array('id_user' => $id_user));
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function get_user_following($id_user) {
    $req = $this->bdd->prepare("SELECT login FROM follow INNER JOIN users
      ON users.id_user = follow.id_following WHERE id_follower = :id_user");
    $req->execute(array('id_user' => $id_user));
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function user_is_in_db($pseudo) {
    $req = $this->bdd->prepare("SELECT login FROM users WHERE login = :login");
    $req->execute(array('login' => $pseudo));
    $data = $req->rowCount();
    if ($data === 1)
      return true;
    else
      return false;
  }

  public function get_user_like($id_user) {
    $req = $this->bdd->prepare("SELECT likes.id_like, likes.id_user AS 
      like_user, likes.date_like, tweets.*, users.login
      FROM likes INNER JOIN tweets ON tweets.id_tweet = 
      likes.id_like INNER JOIN users ON tweets.id_user = users.id_user 
      INNER JOIN profiles ON profiles.id_profile = users.id_profile WHERE 
      likes.id_user = :id_user ORDER BY created DESC");
    $req->execute(array('id_user' => $id_user));
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function get_user_rt($id_user) {
    $req = $this->bdd->prepare("SELECT users.login, retweets.date_retweet 
      AS 'created', tweets.content, tweets.id_user, tweets.id_tweet
      from retweets INNER JOIN tweets ON 
      retweets.id_tweet = tweets.id_tweet INNER JOIN users ON 
      users.id_user = retweets.id_user WHERE retweets.id_user = 
      :id_user");
    $req->execute(array('id_user' => $id_user));
    $data = $req->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public function get_nb_like($id_tweet) {
    $req = $this->bdd->prepare("SELECT COUNT(id_like) FROM likes WHERE
      id_like = :id_like");
    $req->execute(array('id_like' => $id_tweet));
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data["COUNT(id_like)"];
  }
  public function get_nb_rt($id_tweet) {
    $req = $this->bdd->prepare("SELECT COUNT(id_tweet) FROM retweets WHERE
      id_tweet = :id_tweet");
    $req->execute(array('id_tweet' => $id_tweet));
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data["COUNT(id_tweet)"];
  }

  public function follow_user($id_user) {
    $req = $this->bdd->prepare("INSERT INTO follow (id_follower, id_following)
      VALUES (:id_session, :id_user)");
    $req->execute(array(
      'id_session' => $_SESSION['id_user'],
      'id_user' => $id_user
      ));
  }

  public function unfollow_user($id_user) {
    $req = $this->bdd->prepare("DELETE FROM follow
      WHERE id_follower=:id_session AND id_following=:id_user");
    $req->execute(array(
      'id_session' => $_SESSION['id_user'],
      'id_user' => $id_user
      ));
  }

  public function add_tweet($tab) {
    if (strlen($tab['content']) < 140) {
      $req = $this->bdd->prepare("INSERT INTO tweets (content, id_user) VALUES 
        (:content, :id_auteur);");
      $req->execute(array(
        'content' => $tab['content'],
        'id_auteur' => $_SESSION["id_user"]
        ));
      return true;
    }
    else {
      return false;
    }
  }

  public function pseudo_to_id($pseudo) {
    $req = $this->bdd->prepare("SELECT id_user FROM users 
      WHERE login = :pseudo");
    $req->execute(array('pseudo' => $pseudo));
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  public function id_to_pseudo($id) {
    $req = $this->bdd->prepare("SELECT login FROM users WHERE id_user=:id");
    $req->execute(array('id' => $id));
    $data = $req->fetch(PDO::FETCH_ASSOC);
    return $data;
  }
  public function delete_tweet($id_tweet) {
    $req = $this->bdd->prepare("DELETE FROM likes WHERE id_like = 
      :id_tweet");
    $req->execute(array(
      'id_tweet' => $id_tweet
      ));
    $req = $this->bdd->prepare("DELETE FROM retweets WHERE id_retweet = 
      :id_tweet");
    $req->execute(array(
      'id_tweet' => $id_tweet
      ));
    $req = $this->bdd->prepare("DELETE FROM tweets WHERE id_tweet = :id_tweet
      AND id_user = :id_user");
    $req->execute(array(
      'id_tweet' => $id_tweet,
      'id_user' => $_SESSION["id_user"]
      ));
  }
  public function like_tweet($id_tweet) {
    $req = $this->bdd->prepare("SELECT * FROM likes WHERE id_user = :id_user");
    $req->execute(array(
      'id_user' => $_SESSION["id_user"]
      ));
    $res = $req->fetchAll(PDO::FETCH_ASSOC);
    for ($i=0; $i < count($res); $i++) { 
      if  ($res[$i]["id_like"] == $id_tweet && $res[$i]["id_user"] == 
        $_SESSION["id_user"]) {
        $dislike = true;
    }
  }
  if (isset($dislike)) {
    $req = $this->bdd->prepare("DELETE FROM likes WHERE id_like = :id_like 
      AND id_user = :id_user");
    $req->execute(array(
      'id_like' => $id_tweet,
      'id_user' => $_SESSION["id_user"]
      ));
  }
  else {
    $req = $this->bdd->prepare("INSERT INTO likes (id_like, id_user) VALUES 
      (:id_like, :id_user)");
    $req->execute(array(
      'id_like' => $id_tweet,
      'id_user' => $_SESSION["id_user"]
      ));
  }
}
public function retweet_tweet($id_tweet) {
  $req = $this->bdd->prepare("SELECT * FROM retweets WHERE id_user = :id_user");
  $req->execute(array(
    'id_user' => $_SESSION["id_user"]
    ));
  $res = $req->fetchAll(PDO::FETCH_ASSOC);
  for ($i=0; $i < count($res); $i++) { 
    if  ($res[$i]["id_tweet"] == $id_tweet && $res[$i]["id_user"] == 
      $_SESSION["id_user"]) {
      $dislike = true;
  }
}
if (isset($dislike)) {
  $req = $this->bdd->prepare("DELETE FROM retweets WHERE id_tweet = :id_tweet 
    AND id_user = :id_user");
  $req->execute(array(
    'id_tweet' => $id_tweet,
    'id_user' => $_SESSION["id_user"]
    ));
}
else {
  $req = $this->bdd->prepare("INSERT INTO retweets (id_tweet, id_user) VALUES 
    (:id_tweet, :id_user)");
  $req->execute(array(
    'id_tweet' => $id_tweet,
    'id_user' => $_SESSION["id_user"]
    ));
}
}
}
