<!DOCTYPE html>
<html lang="en">
<head>
  <title>ITB Menulis</title>
</head>
<body>
      <div class="content">
            <?php

            $url = array();
            $cookie_name = "data_url";

            if(isset($_COOKIE[$cookie_name])){
            	$url = unserialize($_COOKIE[$cookie_name]);
            }else{
            	$url = array("https://riochr17.wordpress.com/feed/", "https://medium.com/feed/@serunifauzialestari", "https://rinaldimunir.wordpress.com/feed", "https://medium.com/feed/@rafidwiriz", "https://readablemind.wordpress.com/feed", "https://medium.com/feed/@Nicoloci");
            } // daftar inisiasi blog

            // submit rss ke cookie
            if(isset($_POST['blogrss'])){
            	if(!in_array($_POST['blogrss'], $url)){
  	          	array_push($url, $_POST['blogrss']);
  	          	setcookie($cookie_name, serialize($url));
  	        }
            }

            //menyimpan url blog yang baru di submit ke dalam array
            $data_to_show = array();
            foreach($url as $key => $value){
  			$xml = simplexml_load_file($value);
  			foreach($xml->channel->item as $itm){
  				array_push($data_to_show, $itm);
  			}
  	      }
  	      	

  	      	//menampilkan daftar konten blog
  			echo '<ul class="list-group">';
  			foreach($data_to_show as $key => $itm) {
  				$title = $itm->title;
  				$link = $itm->link;
  				$description = $itm->description;
  				$date = $itm->pubDate;
  				echo '<class="list-group-item"><a href =" '.$link.'">' .$title.'</a> <br>'.$description.'<br><b>' .$date.'</b><br><br>';
  			}

  			echo '</ul>';
            ?>
      </div>
</body>
</html>