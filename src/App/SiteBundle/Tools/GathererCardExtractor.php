<?php


namespace App\SiteBundle\Tools;

class GathererCardExtractor
{
    protected $id;

    protected $uri = 'http://gatherer.wizards.com';

    protected $cardQuery = '/Pages/card/Details.aspx?multiverseid=%d';


    public function __construct($id)
    {
        $this->id = $id;
    }

    public function extract()
    {
        $fetch = sprintf($this->uri.$this->cardQuery, urlencode($this->id));

        $ch = curl_init($fetch);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);
        curl_close($ch);

        $match = array();
        preg_match('#<div id="ctl00_ctl00_ctl00_MainContent_SubContent_SubContent_.*>(.*)</div>#s', $content,  $match);

        echo '<pre>';
        var_dump($match);
        echo '</pre>';
        exit;

        echo $content;
        exit;
    }



}