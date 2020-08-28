<?php
  $uploaddir = 'files/';
  $name = md5(rand(10,99));
  $uploadfile = $uploaddir . $name . '.jpg';
  if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
      img_compress($uploadfile);
      echo "The file is correct and was successfully uploaded.\n";
  }

  function img_compress($img){
    
    $imagickSrc = new Imagick($img);
    $compressionList = [Imagick::COMPRESSION_JPEG2000
    ];

    $imagickDst = new Imagick();
    $imagickDst->setCompression(80);
    $imagickDst->setCompressionQuality(80);
    $imagickDst->newPseudoImage(
          $imagickSrc->getImageWidth(),
          $imagickSrc->getImageHeight(),
          'canvas:white'
    );

    $imagickDst->compositeImage(
        $imagickSrc,
        Imagick::COMPOSITE_ATOP,
        0,
        0
    );
    $imagickDst->setImageFormat("jpg");
    $imagickDst->writeImage($img);
        
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Compress Image</title>
  </head>
  <body>
    <h1>Imagick Image Compression</h1>
    <div class="content-body">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <form enctype="multipart/form-data" action="" method="POST">
            <div class="controls">
                <input class="form-control" name="img" type="file" multiple accept="image/*,image/jpeg"  required/>
            </div><br>
           <input type="submit" class="btn btn-success btn-icon bottom15 right15" value="Send file" />
            
        </form>
      </div>
    </div>
  </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
