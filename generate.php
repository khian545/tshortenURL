<?php
include "template/header.php";
?>

<div class="container">
  <div class="row">
    <div class="col-sm">
      <?php
        include 'URLShortener.php';
        $shortener = new URLShortener();
        $shortener->data["destination"] = $_GET["destination"];
        echo '...Generating...';
        echo '<br/>';
        $shorURL = $shortener->generateShortURL();
        if($shorURL === ''){
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Sorry!</strong> There was a problem with your URL.
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }else{
          echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Generated successfully!</strong>
                  <a target="_blank" href="http://'.$shorURL.'">'.$shorURL.'</a>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>';
        }
        echo '<br/>'; echo '<br/>';
      ?>

      <form action="index.php" method="get">
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Back</button>
        </div>
      </form>

    </div>
  </div>

</div>

<?php
include "template/footer.php";
 ?>
