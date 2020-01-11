<?php
session_start();
// MŰKÖDÉSRŐL BŐVEBBEN : https://github.com/woltery99/myMusic/wiki
include_once('CONFIG/config.php');

$bio = $_SESSION['bio'];
$profpic = $_SESSION['profpic'];
$artistName = $_GET["artistname"];

if(mysqli_connect_error()) die('nem sikerült a db csatlakozás');
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <?php include_once("COMPONENTS/headerMeta.php");?>
        <title>Üdvözlünk
            <?php echo $_SESSION['username'];?>
        </title>
    </head>
    <body class="bodyblack">
        <style>
            body {
                background-color:#F2F2F2;
            }
            h2 {
                color: grey;
            }
            h4{
                color: black;
            }
            .tile{
              width: 100%;
            }
            .tile h2,h1{
              text-align: center;
            }
            .track-container{
              display: block;
            }
        </style>
<?php include_once("COMPONENTS/navbar.php");?>
<div class="divider">
<?php include_once("COMPONENTS/sidebar.php");?>
<div class="track-container">
  <div class="searched-header" style="background-color:#303030">
      <div class="tile">
        <h2>  <?php echo "HITS OF "?></h2>
        <h1>  <?php echo $artistName;?></h1>
      </div>
  </div>
        <?php $sql = "SELECT * FROM songs WHERE artist = '$artistName'";
        $result = mysqli_query($dbc,$sql);
        while($row = mysqli_fetch_assoc($result)) {?>
        <div class="track">
        <div class="thing">
        <i id="addPlayListButton" class="fas fa-plus-circle  fa-1x"></i>
        </div>
        <div class="track-number">
        <h2><?php echo $row['artist'];?></h2>
        </div>
     <div class="track-number">
        <h2><?php echo $row['id'];?></h2>
        </div>
        <div class="track-added">
        <h2><?php echo $row['time'];?></h2>
        </div>
        <div class="track-audio">
        <a href="../songs/<?php echo $row['filename']; ?>"></a>
        <i id="playbutton" class="fas fa-play-circle"></i>
        <a id="albumcover" href="../img/albumcover/<?php echo $row['covername']; ?>"></a>
        </div>
        <div class="track-title">
        <h2><?php echo $row['name'];?></h2>
        </div>
        </div>
        <?php
      }//while end ?>

     </div>
   </div>

     <?php include_once("COMPONENTS/player.php");?>
     <?php include_once("COMPONENTS/footer.php");?>
     <script type="text/javascript">
     $(document).on('click','#playbutton',function(){
        src = $(this).next().attr("href");
        console.log(src);
        $("#playerImage").attr("src",src);
        $(".searched-header").css("background-image","url("+src+")");
      })
     </script>
     <script type="text/javascript" src="../JS/jquery-3.4.1.min.js" charset="utf-8"></script>
     <script type="text/javascript" src="../JS/music-player.js" charset="utf-8"></script>
     <script type="text/javascript" src="../JS/script.js" charset="utf-8"></script>
     <script type="text/javascript" src="../JS/main.js" charset="utf-8"></script>
     <script type="text/javascript" src="../JS/music-related.js" charset="utf-8"></script>
     <script type="text/javascript" src="../JS/jquery.easy-autocomplete.min.js" charset="utf-8"></script>
     <script type="text/javascript" src="../JS/ajax-search.js" charset="utf-8"></script>
    </body>
    </html>