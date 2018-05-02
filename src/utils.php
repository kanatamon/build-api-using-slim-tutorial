<?php

function getSumOfStudentID(string $studentID) {
  // แปลงค่า `$studentID` ไปเป็น array ของตัวเลข
  // ตัวอย่าง; `550610492` => [5,5,0,6,1,0,4,9,2]
  $numbersArray = str_split($studentID);
  foreach ($numbersArray as $value) {
    $value = (int) $value;
  }
    
  $curl = curl_init();

  $body = array(
    'numbers' => $numbersArray,
  );
  $json = json_encode($body);

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'localhost:8080/sum',
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => $json,
    CURLOPT_HTTPHEADER => array(
      'Content-Type: application/json',
    ),
  ));
  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
    throw new Exception('cURL Error #:' . $err);
  } else {
    return $response;
  }
}
