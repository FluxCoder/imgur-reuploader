<?php
$img = "null";

function download($url){
  global $img;
  $temp = rand();
  $img    = 'temp-'.$temp.'.png';
  $file   = file($url);
  $result = file_put_contents("temp/".$img, $file);
}
function upload($img){
  $client_id="71820a5c86132fe";
  $handle = fopen($filename, "r");
  $image = file_get_contents("temp/".$img);
  $data = fread($handle, filesize($filename));
  $pvars   = array('image' => base64_encode($data));
  $timeout = 30;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://api.imgur.com/3/image.json');
  curl_setopt($ch, CURLOPT_POST, TRUE);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Client-ID ' . $client_id));
  curl_setopt($ch, CURLOPT_POSTFIELDS, array('image' => base64_encode($image)));

  $reply = curl_exec($ch);
  curl_close($ch);

  $reply = json_decode($reply);
  unlink("temp/".$img);
  
  return $reply->data->link;
}
if(isset($_GET["url"])){
  download($_GET["url"]);
  echo $img;
  upload($img);
}
if(isset($_POST["url"])){
  download($_POST["url"]);
  $imgururl = upload($img);
}
?>
<html>
  <head>
    <!-- BootStrap Loaded Via CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.css">
    <link rel="stylesheet" href="http://getbootstrap.com/examples/starter-template/starter-template.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Imgur - Reuploading Script</title>
    <meta name="description" content="A Free PHP Script for Imgur Reuploading. This script Download from URL and uploads it to Imgur in seconds!" />
    <meta name="keywords" content="Image, Reuploader, Free, Script, Open, source, download, reupload, upload, how to, php, scripts, FluxCoder"/>
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">Imgur Reuploader</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="">Home</a></li>
            <li><a href="?api">Tiny API</a></li>
            <li><a href="">Download Script</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Upload Images to Imgur from URL</h1>
        <?php if(!isset($_POST["url"])){ ?>
        <form method="POST" action="">
          <div class="form-group">
            <label for="inputsm">Image URL</label>
            <input class="form-control input-sm" id="inputsm" name="url" type="text" placeholder="http://example.com/img.png">
          </div>
        </form>
        <?php } else { ?>
        <div class="form-group" id="url">
          <center><b>Preview:</b> <br /><img src="<?php echo $imgururl; ?>" style="width: 20%;" /></center>
          <label for="inputsm">Imgur URL</label>
          <input class="form-control input-sm" id="imgur" type="text" value="<?php echo $imgururl; ?>">
        </div>
        <button type="button" class="btn btn-default" onclick="another()">Reupload Another</button>
        <hr id="hr" style="width: 70%;box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19) !important;display:none;"/>
        <form method="POST" action="" id="upload" style="display:none;">
          <div class="form-group">
            <label for="inputsm">Image URL</label>
            <input class="form-control input-sm" id="inputsm" name="url" type="text" placeholder="http://example.com/img.png">
          </div>
        </form>
        <?php } ?>
      </div>

    </div><!-- /.container -->
    <br /><br /><br />
    <footer class="footer">
      <div class="container">
        <p class="text-muted">Created By FluxCoder. &copy; FluxCoder Web Development Services</p>
      </div>
    </footer>
    <script   src="https://code.jquery.com/jquery-3.1.0.js"   integrity="sha256-slogkvB1K3VOkzAI8QITxV3VzpOnkeNVsKvtkYLMjfk="   crossorigin="anonymous"></script> 
    <script type="text/javascript">
    function another(){
      $('#upload').fadeIn();
      $('#hr').fadeIn();
    }
    </script>
  </body>
</html>
