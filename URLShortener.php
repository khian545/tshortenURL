<?php
class URLShortener
{
  public $data = ["fullName" => "rebrand.ly",
            "destination" => "https://www.youtube.com/channel/UCHK4HD0ltu1-I212icLPt3g",
            "domain" => "",
            "slashtag" => "",
            "title" => "Rebrandly YouTube channel",
            "apikey" => "54eec15ff2634b4c9fee25a517ac83d5",
            "workspace" => "ea9d1b8ed5df476e9dcb06cb684b0420"];

  public function __construct(){
    error_reporting(-1); //error reporting flags
  }

  public function generateShortURL()
  {
    try{
      $response = [];
      $domain_data["fullName"] = $this->data["fullName"];
      $post_data["destination"] = $this->data["destination"];
      $post_data["domain"] = $domain_data;
      $post_data["slashtag"] = $this->data["slashtag"];
      $post_data["title"] = $this->data["title"];
      $ch = curl_init("https://api.rebrandly.com/v1/links");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          "apikey: ". $this->data["apikey"],
          "Content-Type: application/json",
          "workspace: " . $this->data["workspace"]
      ));
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));

      $result = curl_exec($ch);

      curl_close($ch);
      $response = json_decode($result, true);
      return ($response["shortUrl"] == null) ? '' :$response["shortUrl"];

    }catch(Exception $e){
      return '';
    }

  }

  public function getLinks()
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.rebrandly.com/v1/links");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "apikey: " . $this->data["apikey"],
        "Content-Type: application/json",
        "workspace: " . $this->data["workspace"]
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result,true);
    return $response;
  }

  public function getLinksCount()
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.rebrandly.com/v1/links/count");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "apikey: " . $this->data["apikey"],
        "Content-Type: application/json",
        "workspace: " . $this->data["workspace"]
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result,true);
    return $response["count"];
  }

  public function getIDbySlashTag()
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, "https://api.rebrandly.com/v1/links?slashtag=" . $this->data["slashtag"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "apikey: " . $this->data["apikey"],
        "Content-Type: application/json",
        "workspace: " . $this->data["workspace"]
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    $response = json_decode($result,true);
    return $response[0]["id"];
  }

  public function deleteShortenLink()
  {
     $id = $this->getIDbySlashTag($this->data["slashtag"]);
     $url = "https://api.rebrandly.com/v1/links/" . $id;
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
     //curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
         "apikey: " . $this->data["apikey"],
         "Content-Type: application/json",
         "workspace: " . $this->data["workspace"]
     ));

     $result = curl_exec($ch);
     $result = json_decode($result,true);
     curl_close($ch);

     echo $id . " has been deleted.";
     echo $result["status"];
  }
}

?>
