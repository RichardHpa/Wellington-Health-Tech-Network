<?php
    $url = $_GET['url'];
    $html = file_get_contents($url);

    preg_match_all( '|<img.*?src=[\'"](.*?)[\'"].*?>|i',$html, $matches );

    preg_match_all('/<title.*?>(.*)<\/title>/msi',$html, $subresult);
    $urlHeading = $subresult[1][0];

    $result = array();
    $result['url'] = $matches[1][0];
    $result['heading'] = $urlHeading;

    header('Content-Type: application/json');
    echo json_encode($result);
