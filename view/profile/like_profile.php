        <?php
        $j = 0;
        while (isset($profile_data[$j])) {
          $j++;
        }
        for ($i = 0; $i <= $j - 1; $i++) {
      // $profile_data[$i]['content'] =
      //htmlspecialchars($profile_data[$i]['content']);
      // $profile_data[$i]['content'] = preg_replace("#@([a-zA-Z0-9_-]+)(\s)#",
      //   "<a href='/".DIRNAME."/profile/user/$1'>@$1</a> ",
      //$profile_data[$i]['content']);
          echo '<div class="panel panel-info vert-offset-top-2">
          <div class="panel-heading">
            <a href="/'.DIRNAME.'/profile/user/'.$profile_data[$i]['login'].
            '" class="panel-title">@'.$profile_data[$i]['login'].'</a>
            <form class="pull-right" method="POST"><button type="submit" value="' .
              $profile_data[$i]  ["id_tweet"] . '" name="delete"><i
              class="glyphicon glyphicon-remove"></i></button></form>
            </div>
            <div class="panel-body">
              <div class="col-xs-2">
                <img class="img-responsive" src="/'.DIRNAME
                .'/misc/default_profile.png" alt="profile_pic">
              </div>
              <div class="col-xs-9 col-xs-offset-1">
                <p>'.$profile_data[$i]['content'].'</p>
              </div>
            </div>
            <div class="panel-footer">
              <a href="/' . DIRNAME . '/profile/tweet_like/' .
              $profile_data[$i]["id_tweet"] . '"><span
              class="glyphicon glyphicon-heart col-xs-offset-4"></span></a>
              <span class="col-xs-offset-1">' . $profile_data[$i]["nb_tweet"] .
                '</span>
                <a href="/' . DIRNAME . '/profile/retweet/' .
                $profile_data[$i]["id_tweet"] . '"><span class="glyphicon glyphicon-retweet col-xs-offset-1">
              </span></a>
              <span class="col-xs-offset-1">' . $profile_data[$i]["nb_rt"] . '</span>
            </div>
          </div>';}
          ?>
          </div>
          </div>
          </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <?php echo '<script src="/' . DIRNAME .'/js/reload_auto.js"></script>'?>
        <?php echo '<script src="/' . DIRNAME .'/js/script.js"></script>'?>
