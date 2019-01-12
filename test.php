<?php
// $API_ENDPOINT = "https://www.wikidata.org/w/api.php";
// $query = "donald trump";
// $params = array(
//     action => 'wbsearchentities',
//     format => 'json',
//     language => 'en',
//     search => $query
// );

// // Get cURL resource
// $curl = curl_init();
// curl_setopt_array($curl, array(
//     CURLOPT_RETURNTRANSFER => 1,
//     CURLOPT_URL => $API_ENDPOINT,
//     CURLOPT_USERAGENT => 'Codular Sample cURL Request',
//     CURLOPT_POST => 1,
//     CURLOPT_POSTFIELDS => $params
// ));
// $resp = curl_exec($curl);
// curl_close($curl);

// //print($resp);

// $result = json_decode($resp);
//print_r($result);
//print_r($result->search[0]->description);


// // Check if there is such a page
// if (empty($result->search)) {
//     echo "empty";
// }


// $endpointUrl = 'https://query.wikidata.org/sparql';
// $sparqlQuery = <<< 'SPARQL'
// SELECT ?person ?personLabel
// WHERE {
//   ?person wdt:P27 wd:Q794 .
//   ?person wdt:P69 wd:Q13371 .
//   SERVICE wikibase:label {
// 		bd:serviceParam wikibase:language "fa" .
// 	}
//   }
// SPARQL;

// $res = file_get_contents( $endpointUrl . '?query=' . urlencode( $sparqlQuery )  );
// echo (is_array($res));
// // foreach ($res as $i) {
// //     echo $res->$i;
// // }


?>