<?php

interface ServiceConnector
{
    public function getAllHotels();
    public function getHotelInformation($href);
    public function sortFunction($sortBy);
}