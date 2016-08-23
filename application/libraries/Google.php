<?php

/**
* Responsible for performing interactions with the google API
*/
class Google
{
  private $url_api;

  /**
   * @param string $url_api URL api google (optional)
   */
  function __construct($url_api = 'http://maps.google.com/maps/api/')
  {
    $this->url_api = $url_api;
  }

  /**
   * Takes the latitude and longitude of an address
   * @param  string        $address  address should be sought
   * @return array|false             if you do not find the address returns false if it will not return latitude and longitude formatted address
   */
  public function geocode($address)
  {
    $result = json_decode(file_get_contents($this->url_api . 'geocode/json?address=' . urlencode($address)), true);

    if(!$result || $result['status'] != 'OK') {
      return false;
    }

    return [
      'lat' => $result['results'][0]['geometry']['location']['lat'],
      'lng' =>$result['results'][0]['geometry']['location']['lng'],
      'formatted_address' => $result['results'][0]['formatted_address']
    ];
  }

  /**
   * Returns the distance between two points of latitude and longitude
   * @param  array  $address_from latitude and longitude of point 1
   * @param  array  $address_to   latitude and longitude of point 2
   * @return array                distance and duration between points
   */ 
  public function distance(array $address_from, array $address_to)
  {
    $url = $this->url_api . 'distancematrix/json?'
          . 'origins=' . $address_from['lat'] . ',' . $address_from['lng']
          . '&destinations=' . $address_to['lat'] . ',' . $address_to['lng']
          . '&mode=driving&language=en-UK';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $result = json_decode(curl_exec($ch), true);
    curl_close($ch);

    return [
      'distance' => $result['rows'][0]['elements'][0]['distance']['value'],
      'duration' => $result['rows'][0]['elements'][0]['duration']['value']
    ];
  }
}
