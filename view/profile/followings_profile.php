<h4><?php echo $profile_data['firstname'] . " " . $profile_data['name'] . " ";?>
suit :</h4>
<?php
for ($i = 0; $i < count($data); $i++) {
  echo '<a href="/'.DIRNAME.'/profile/user/'.$data[$i]["login"].'">@'.
  $data[$i]['login'] . '</a><br>';
}
?>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<?php echo '<script src="/' . DIRNAME .'/js/reload_auto.js"></script>'?>
<?php echo '<script src="/' . DIRNAME .'/js/script.js"></script>'?>