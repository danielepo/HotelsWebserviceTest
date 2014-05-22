<?php

class ServiceConnectorDummyWithMoreHotelData implements ServiceConnector
{

  public function getAllHotels()
  {

    return null;
  }

  public function getHotelInformation($href)
  {
    $xmlstring = '<hotel tipo="hotel" id="1072" stelle="2" eta_max_ridotti="12">'
        . '<esercizio has_logo="false" id="1072">'
        . '<nome><![CDATA[ Hotel Rio ]]></nome>'
        . '<web><![CDATA[ http://www.hotelriolignano.com ]]></web>'
        . '<email><![CDATA[ info@hotelriolignano.com ]]></email>'
        . '<telefono><![CDATA[ +39.0431.71280 ]]></telefono>'
        . '<fax><![CDATA[ +39.0431.71637 ]]></fax>'
        . '<longitudine>13.1333118</longitudine>'
        . '<latitudine>45.6886596</latitudine>'
        . '<indirizzo><![CDATA[ Via Friuli ]]></indirizzo>'
        . '<numero><![CDATA[ 15 ]]></numero>'
        . '<citta id="1"><![CDATA[ Lignano Sabbiadoro ]]></citta>'
        . '<zona id="1"><![CDATA[ Sabbiadoro ]]></zona>'
        . '</esercizio>'
        . '</hotel>';
    return $xmlstring;
  }

//put your code here
}
