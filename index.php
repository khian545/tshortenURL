
<?php
include "template/header.php";
include "URLShortener.php";

$shortener = new URLShortener();
$count = $shortener->getLinksCount();
$slashtagForDelete = (isset($_POST['delete-slashtag'])) ? $_POST['delete-slashtag'] : 0;
$deleteSuccess = false;
$deletedLinkData = [];

if($slashtagForDelete){
  $deletedLinkData = $shortener->deleteShortenLink();
  $count = $shortener->getLinksCount();
  $deleteSuccess = true;
}
?>

<div class="container">
  <div class="row">
    <div class="col-sm">

      <form action="generate.php" method="get">
        <div class="form-group">
          <label>Destination URL</label>
          <input class="form-control" name="destination" type="text" />
          <small  class="form-text text-muted">Enter the link here.</small>
        </div>
        <div class="form-group">
          <button class="btn btn-primary" type="submit">Create</button>
        </div>
      </form>

    </div>
  </div>

  <?php
  if($deleteSuccess){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Removed!</strong> '.$deletedLinkData['id'].' has been removed.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
    </div>';
  }
  ?>

  <h3>List of Shortened Links <span class="badge badge-warning"><?=$count ?> links created</span></h3>
  <table class="table table-striped">
    <tr>
      <th>No.</th>
      <th>ID</th>
      <th>Short URL</th>
      <th>Destination URL</th>
      <th>Action</th>
    </tr>
    <?php
    $links = $shortener->getLinks();
    $counter = 1;
    foreach ($links as $link) {
      echo '<tr>';
      echo '<td>'. $counter++ . '</td>';
      echo '<td>'. $link["id"] . '</td>';
      echo '<td><a target="_blank" href="http://'. $link["shortUrl"] . '"/>'.$link["shortUrl"].
      '</a><br/><span class="badge badge-success">'.$link["clicks"].
      ' clicks</span></td>';
      echo '<td>'. $link["destination"] . '<br/><span class="badge badge-primary">'.$link["title"].'</span></td>';
      echo '<td>';
      echo '<form action="index.php" method="post">';
      echo '<div class="form-group">';
      echo '<input type="hidden" value="' . $link["slashtag"] . '" name="delete-slashtag" />';
      echo '<button class="btn btn-danger btn-sm" type="submit">Remove</button>';
      echo '</div>';
      echo '</form>';
      echo '</td>';
      echo '</tr>';
    }
    ?>
  </table>


  <!--
  <div class="row">
  <div class="col-sm">

  <form action="delete.php" method="get">
  <div class="form-group">
  <label>Slashtag</label>
  <input class="form-control" name="slashtag" type="text"/>
  <small  class="form-text text-muted">Enter the slashtag here here.</small>
</div>
<div class="form-group">
<button class="btn btn-danger" type="submit">Delete</button>
</div>
</form>

</div>
</div>
-->

</div>

<?php
include "template/footer.php";
?>
