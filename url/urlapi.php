    <?php

      ob_start();
      require 'database.php'; //database connection
      $base_url='http://localhost:4006/url/';
      if(isset($_GET['url']) )
      {
      $url=urldecode($_GET['url']);
      if (filter_var($url, FILTER_VALIDATE_URL))
      {
      // Check connection
      global $db;
      $db = new PDO($dsn, $username, $password);

      $short=ShortUrl($url);
      echo $base_url.$short;
      }
      else
      {
      die("$url is not a valid URL");
      }
      }
      else
      {
      include 'index.htm';
      }

      if(isset($_GET['redirect']) )
      {
      $short=urldecode($_GET['redirect']);

      // Check connection
      global $db;
      $db = new PDO($dsn, $username, $password);
      $url= RedirectUrl($short);
      header("location:".$url);
      exit;
      }

      function ShortUrl($url)
      {
       $queryc = "SELECT * FROM link WHERE url = '".$url."' ";
       global $db;
       $urls = $db->query($queryc);
       if ($urls->rowCount() > 0) {
      $row = $urls->fetch(PDO::FETCH_ASSOC);

       return $row['short_code']; //if url exists return the short code
      } else {
        //if url not in database insert
       if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
           $user_ip= $_SERVER['HTTP_X_FORWARDED_FOR'];
       } else {
           $user_ip = $_SERVER['REMOTE_ADDR'];
       }
       $browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
       $referer = $_SERVER['HTTP_HOST'];
      $short_code = UniqueID(); //generate random code
       $sql= "INSERT INTO link
                             (url, short_code, hits, user_ip, browser, referer,lastused)
                          VALUES
                             ('$url', '$short_code', '0', '$user_ip', '$browser', '$referer','0')";
       if ($db->query($sql) === TRUE) {
       return $short_code;
       }
       }
       }
       //Generate random code for the url
      function UniqueID(){
       global $db;
       $shortcode = substr(md5(uniqid(rand(), true)),0,6); // creates a 6 digit unique short id
       $query = "SELECT * FROM link WHERE short_code = '".$shortcode."' ";
       $result = $db->query($query);
       if ($result->rowCount() > 0) {
       UniqueID();
       } else {
       return $shortcode; //return unique code
       }
      }
      //HTTP_USER_AGENT get user specific browser
      function get_browser_name($user_agent)
      {
          if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
          elseif (strpos($user_agent, 'Edge')) return 'Edge';
          elseif (strpos($user_agent, 'Chrome')) return 'Chrome';
          elseif (strpos($user_agent, 'Safari')) return 'Safari';
          elseif (strpos($user_agent, 'Firefox')) return 'Firefox';
          elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
          return 'Other';
      }
    //Get original link wih short code
      function RedirectUrl($short){
       global $db;
       $query = "SELECT * FROM link WHERE short_code = '".addslashes($short)."' ";
       $result = $db->query($query);
       if ($result->rowCount() > 0) { //if result  exists return full url
      $row = $result->fetch(PDO::FETCH_ASSOC);

      $hits=$row['hits']+1; // increase the hit
      $sql = "update link set hits='".$hits."'   where id='".$row['id']."' "; // updates hit for the url
      $sqll ="update link set lastused = CURRENT_TIMESTAMP  where id='".$row['id']."' "; //last time url was accessed.
      $db->query($sql);
      $result2 = $db->query($sqll);
      return $row['url'];
      }
      else
       {
      die("Invalid Link!");
      }
      }
      ?>