<?php
  function alphaToDec($val){
    $pow=0;
    $res=0;
    while($val!=""){
      $cur=$val[strlen($val)-1];
      $val=substr($val,0,strlen($val)-1);
      $mul=ord($cur)<58?$cur:ord($cur)-(ord($cur)>96?87:29);
      $res+=$mul*pow(62,$pow);
      $pow++;
    }
    return $res;
  }

  require('db.php');
  $query = explode('/',$_GET['i']);
  $title = 'whitehot robot games';
  $image = 'https://srmcgann.github.io/assets/1pnBdc.png';
  if($query[0] === 'post'){
    $id = alphaToDec(mysqli_real_escape_string($link, $query[1]));
    $sql = 'SELECT * FROM games WHERE id = ' . $id;
    $res = mysqli_query($link, $sql);
    if(mysqli_num_rows($res)){
      $row = mysqli_fetch_assoc($res);
      $title = $row['author'] . ' - ' . $row['title'];
      $sql = 'SELECT name, avatar FROM users WHERE name LIKE "' . $row['author'] . '"';
      $res = mysqli_query($link, $sql);
      if(mysqli_num_rows($res)){
        $row = mysqli_fetch_assoc($res);
        if($row['avatar']) $image = $row['avatar'];
      }
    }
  } elseif($query[0] === 'u') {
    $sql = 'SELECT name, avatar FROM users WHERE name LIKE "' . mysqli_real_escape_string($link, $query[1]) . '";';
    $res = mysqli_query($link, $sql);
    if(mysqli_num_rows($res)){
      $row = mysqli_fetch_assoc($res);
      if($row['name']) $title = 'games - ' . $row['name'];
      if($row['avatar']) $image = $row['avatar'];
    }
  } else {
    $image = 'https://srmcgann.github.io/assets/1GY3GM.png';
  }
  $url =  (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https:" : "http:") . "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
  $url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
  $type = 'website';
  $description = 'games.dweet.net - a free blog';
?> <!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=1024"><title><?=$title?></title> <? if($image){?> <link rel="icon" href="<?='https://code.dweet.net/imgProxy.php?url='.$image?>"><?}else{?> <link rel="icon" href="https://srmcgann.github.io/assets/1GY3GM.png"> <?}?> <? if($image){?><meta property="og:url" content="<?=$url?>"><?}?> <? if($image){?><meta property="og:type" content="<?=$type?>"><?}?> <? if($image){?><meta property="og:title" content="<?=$title?>"><?}?> <? if($image){?><meta property="og:description" content="<?=$description?>"><?}?> <? if($image){?><meta property="og:image" content="<?=$image?>"><?}?> <? if($image){?><meta property="og:image:secure_url" content="<?='https://code.dweet.net/imgProxy.php?url='.$image?>"><?}?> <link href="css/app.847dc578.css" rel="preload" as="style"><link href="js/app.ee5875d1.js" rel="preload" as="script"><link href="js/chunk-vendors.5c6dbb6f.js" rel="preload" as="script"><link href="css/app.847dc578.css" rel="stylesheet"></head><body><noscript><strong>We're sorry but words.whitehotrobot.com doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript><div id="app"></div><script src="js/chunk-vendors.5c6dbb6f.js"></script><script src="js/app.ee5875d1.js"></script></body></html>