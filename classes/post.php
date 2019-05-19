<?php

//namespace phpProject;

class Post
{
    private $image;
    private $image_text;

    /**
     * Get the value of image.
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set the value of image.
     *
     * @return self
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of image_text.
     */
    public function getImage_text()
    {
        return $this->image_text;
    }

    /**
     * Set the value of image_text.
     *
     * @return self
     */
    public function setImage_text($image_text)
    {
        $this->image_text = $image_text;

        return $this;
    }

    /*
        Alle posts van de databank halen
    */
    public static function get($limit = 20, $offset = 0)
    {
        $conn = Db::getInstance();

        // ID uit de database halen
        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        // Alle post laden van de gevolgde personen
        $statement = $conn->prepare("SELECT posts.id,posts.image,posts.image_text,posts.user_id,
        posts.date AS images_date,users.profileImg,filters.name
        FROM posts,followers,users,filters
        WHERE followers.user_id1=:id
        AND followers.user_id2=posts.user_id 
        AND followers.user_id2 = users.id 
        AND posts.filter_id = filters.id
        UNION SELECT posts.id,posts.image,posts.image_text,posts.user_id,posts.date,users.profileImg,filters.name
        FROM posts,users,filters
        WHERE posts.user_id =:id AND users.id=:id AND posts.filter_id = filters.id ORDER BY `images_date` DESC limit $limit offset $offset");

        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function detailPagina($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT posts.id,posts.image,posts.image_text,posts.user_id,posts.date,posts.filter_id, filters.name, users.profileImg, posts.date
        FROM posts,filters,users where posts.id = $id AND filters.id=posts.filter_id AND users.id= posts.user_id");
        $statement->execute();
        $collection = $statement->fetchAll();

        return $collection;
    }

    public static function profilePic($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT users.profileImg FROM posts,users 
        WHERE posts.user_id = users.id AND posts.id = $id");
        $statement->execute();
        $profilePic = $statement->fetch();

        return $profilePic;
    }

    public static function detectColors($image, $num, $level = 5)
    {
        $level = (int) $level;
        $palette = array();
        $size = getimagesize($image);
        if (!$size) {
            return false;
        }
        switch ($size['mime']) {
      case 'image/jpeg':
        $img = imagecreatefromjpeg($image);
        break;
      case 'image/png':
        $img = imagecreatefrompng($image);
        break;
      case 'image/gif':
        $img = imagecreatefromgif($image);
        break;
      default:
        return false;
    }
        if (!$img) {
            return false;
        }
        for ($i = 0; $i < $size[0]; $i += $level) {
            for ($j = 0; $j < $size[1]; $j += $level) {
                $thisColor = imagecolorat($img, $i, $j);
                $rgb = imagecolorsforindex($img, $thisColor);
                $color = sprintf('%02X%02X%02X', (round(round(($rgb['red'] / 0x66)) * 0x66)), round(round(($rgb['green'] / 0x66)) * 0x66), round(round(($rgb['blue'] / 0x66)) * 0x66));
                $palette[$color] = isset($palette[$color]) ? ++$palette[$color] : 1;
            }
        }
        arsort($palette);

        return array_slice(array_keys($palette), 0, $num);
    }

    public static function search($search)
    {
        $conn = Db::getInstance();
        $stmt = $conn->prepare("SELECT posts.id,posts.image,posts.image_text,posts.date,filters.name,users.profileImg FROM users,colors,posts,filters 
        WHERE posts.image_text like '%$search%' AND filters.id =posts.filter_id AND users.id=posts.user_id UNION SELECT posts.id,posts.image,posts.image_text,posts.date,filters.name,users.profileImg FROM users,colors,posts,filters WHERE colors.color like '%$search%' AND filters.id =posts.filter_id AND users.id=posts.user_id AND posts.id=colors.post_id");
        $stmt->execute();
        $search = $stmt->fetchAll();


        return $search;
    }

    public function getLikes()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare('SELECT count(*) as count from likes where post_id = :postid');
        $statement->bindValue(':postid', $this->id);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }

    public static function getColors($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare("SELECT color FROM colors where post_id = $id");
        $statement->execute();
        $colors = $statement->fetchAll(PDO::FETCH_COLUMN);

        return $colors;
    }

    public static function getFilters()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT * FROM filters');
        $statement->execute();
        $filters = $statement->fetchAll(PDO::FETCH_ASSOC);

        return  $filters;
    }

    public static function getOwnPosts()
    {
        $conn = Db::getInstance();

        // ID uit de database halen
        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('SELECT posts.id,posts.image,posts.image_text,posts.user_id, posts.date,users.profileImg,filters.name
         FROM posts,users,filters WHERE posts.filter_id = filters.id
         AND users.id = posts.user_id AND users.id=:id ORDER BY posts.date DESC');
        $statement->bindValue(':id', $id);
        $statement->execute();
        $posts = $statement->fetchAll();

        return  $posts;
    }

    public static function getPosts($id)
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT posts.id,posts.image,posts.image_text,posts.user_id, posts.date,users.profileImg,filters.name 
        FROM posts,users,filters WHERE posts.filter_id = filters.id 
        AND users.id = posts.user_id AND users.id=:id ORDER BY posts.date DESC');
        $statement->bindValue(':id', $id);
        $statement->execute();
        $posts = $statement->fetchAll();

        return  $posts;
    }

    public static function getTimeAgo($time)
    {
        $conn = Db::getInstance();

        $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
        $stm->execute();
        $id = $stm->fetch(PDO::FETCH_COLUMN);

        $statement = $conn->prepare('SELECT posts.id,posts.date FROM posts WHERE posts.date = :time');
        $statement->bindValue(':time', $time);
        $statement->execute();
        //$timeCalc = $statement->fetchAll(PDO::FETCH_COLUMN);

        /* $cur_time = $time;
         $time_elapsed = $cur_time - $time;
         $seconds = $time_elapsed;
         $minutes = round($time_elapsed / 60);
         $hours = round($time_elapsed / 3600);
         $days = round($time_elapsed / 86400);
         $weeks = round($time_elapsed / 604800);
         $months = round($time_elapsed / 2600640);
         $years = round($time_elapsed / 31207680);

         // Seconds
         if ($seconds <= 60) {
             return $seconds.' seconds ago ';
         }
         //Minutes
         elseif ($minutes <= 60) {
             if ($minutes == 1) {
                 return 'one minute ago';
             } else {
                 return $minutes.' minutes ago';
             }
         }
         //Hours
         elseif ($hours <= 24) {
             if ($hours == 1) {
                 return 'an hour ago';
             } else {
                 return $hours.' hours ago';
             }
         }
         //Days
         elseif ($days <= 7) {
             if ($days == 1) {
                 return 'yesterday';
             } else {
                 return $days.' days ago';
             }
         }
         //Weeks
         elseif ($weeks <= 4.3) {
             if ($weeks == 1) {
                 return 'a week ago';
             } else {
                 return $weeks.' weeks ago';
             }
         }
         //Months
         elseif ($months <= 12) {
             if ($months == 1) {
                 return 'a month ago';
             } else {
                 return $months.' months ago';
             }
         }
         //Years
         else {
             if ($years == 1) {
                 return 'one year ago';
             } else {
                 return $years.' years ago';
             }
         }*/

        $estimate_time = time() - $time;

        if ($estimate_time < 1) {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second',
        );

        foreach ($condition as $sec => $str) {
            $d = $estimate_time / $sec;

            if ($d >= 1) {
                $r = round($d);

                return ' About '.$r.' '.$str.($r > 1 ? 's' : ' ').' ago ';
            }
        }
    }

    public static function getAll()
    {
        $conn = Db::getInstance();

        $statement = $conn->prepare('SELECT posts.id,posts.image,posts.image_text,posts.user_id, posts.date,users.profileImg,filters.name 
        FROM posts,users,filters WHERE posts.filter_id = filters.id 
        AND users.id = posts.user_id  ORDER BY posts.date DESC');
        $statement->execute();
        $posts = $statement->fetchAll();

        return  $posts;
    }

    public static function deleteEdit()
    {
        $conn = Db::getInstance();


        if(isset($_POST['submit'])){
           
            $stm = $conn->prepare("SELECT id FROM users WHERE email = '".$_SESSION['email']."'");
            $stm->execute();
            $userid = $stm->fetch(PDO::FETCH_COLUMN);

            $stm = $conn->prepare("DELETE FROM posts WHERE posts.id,posts.image_text,posts.image,posts.date WHERE posts.id = $postsid");
            $insert->bindParam(':bio', $bio);
            $insert->execute();
            
        if($stm->execute())
        {
        $msg = 'Uw post is verwijderd.';
        header('location:profiel.php');
        }
        else { 
        $msg = 'Something went wrong.';
        }
        }

    }
}
