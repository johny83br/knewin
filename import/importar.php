<?php

require "vendor/autoload.php";

use GuzzleHttp\Client;

$client = new Client([
  'base_uri' => 'http://127.0.0.1:8000',
  'timeout'  => 2.0,
]);

$row = 0;
if (($handle = fopen("news.csv", "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);

    if ($row > 0) {
      list($d, $hora) = explode(' ', $data[1]);
      list($dia, $mes, $ano) = explode('/', $d);

      $dataehora = $ano . '-' . $mes . '-' . $dia . ' ' . $hora . ':00';
      $titulo = $data[0];
      $url = $data[2];
      $fontes = $data[3];
      $conteudo = $data[4];

      $response = $client->request('POST', '/api/news', [
        'form_params' => [
          'title' => $titulo,
          'url' => $url,
          'source' => $fontes,
          'content' => $conteudo,
          'created_at' => $dataehora
        ]
      ]);

      sleep(5);
    }

    $row++;
  }
  fclose($handle);
}
