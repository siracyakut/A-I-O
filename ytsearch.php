<?php

define("MAX_RESULTS", 10);
define("API_KEY", "-");

require_once __DIR__ . '/vendor/autoload.php';

header("Content-Type: application/json");

if (isset($_GET["q"]) && !empty($_GET["q"]))
{
    $max_results = MAX_RESULTS;

    if(isset($_GET["max_results"]) && !empty($_GET["max_results"]))
        $max_results = $_GET["max_results"];

    $client = new Google_Client();
    $client->setDeveloperKey(API_KEY);

    $youtube_service = new Google_Service_YouTube($client);

    try
    {
        $search = $youtube_service->search->listSearch("id,snippet", array(
            "q" => $_GET["q"],
            "maxResults" => $max_results,
            "type" => "video"
        ));
		
		$bulunacak = array('ç','Ç','ı','İ','ğ','Ğ','ü','ö','Ş','ş','Ö','Ü','&#39;','&quot;','&amp;'); 
		$degistir  = array('c','C','i','I','g','G','u','o','S','s','O','U','\'','"','&'); 
		
		foreach ($search["items"] as $searchResult)
		{
			$searchResult["snippet"]["title"] = str_replace("|", "", $searchResult["snippet"]["title"]);
			$searchResult["snippet"]["title"] = str_replace($bulunacak, $degistir, $searchResult["snippet"]["title"]);
			
			echo $searchResult["snippet"]["title"] . "|" . $searchResult["id"]["videoId"];
			echo "\n";
		}

    }
    catch (Exception $exception)
    {
    }
}
