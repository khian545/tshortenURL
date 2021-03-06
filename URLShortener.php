<?php
class URLShortener
{
  public $data = ["fullName" => "",
                  "destination" => "",
                  "domain" => "",
                  "slashtag" => "",
                  "title" => "",
                  "apikey" => "",
                  "workspace" => ""];

  public function __construct()
  {
    error_reporting(-1); //error reporting flags
    $this->data["fullName"] = "rebrand.ly";
    $this->data["destination"] = "https://www.youtube.com/channel/UCHK4HD0ltu1-I212icLPt3g";
    $this->data["title"] = "Rebrandly YouTube channel";
    $this->data["apikey"] = "54eec15ff2634b4c9fee25a517ac83d5";
    $this->data["workspace"] = "ea9d1b8ed5df476e9dcb06cb684b0420";
  }

  public function generateShortURL()
  {
    try{
      $title = $this->getTitle(); //get the meta tags of the url
      $response = [];
      $domain_data["fullName"] = $this->data["fullName"];
      $post_data["destination"] = $this->data["destination"];
      $post_data["domain"] = $domain_data;
      $post_data["slashtag"] = $this->data["slashtag"];
      $post_data["title"] = $title;
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

  public function getTitle()
  {
    $html = $this->fileGetContentsCurl($this->data["destination"]);

    //parsing begins here:
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $nodes = $doc->getElementsByTagName('title');

    //get and display what you need:
    $title = $nodes->item(0)->nodeValue;

    $metas = $doc->getElementsByTagName('meta');

    for ($i = 0; $i < $metas->length; $i++)
    {
      $meta = $metas->item($i);
      if($meta->getAttribute('name') == 'description')
      $description = $meta->getAttribute('content');
      if($meta->getAttribute('name') == 'keywords')
      $keywords = $meta->getAttribute('content');
    }
    return $title;
    //echo "Title: $title". '<br/><br/>';
    //echo "Description: $description". '<br/><br/>';
    //echo "Keywords: $keywords";
  }

  private function fileGetContentsCurl($url)
  {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
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

    $data = ["id" => $id,
    "status" => $result["status"]];

    return $data;
  }
}

?>
