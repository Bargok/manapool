<?php

namespace App\SiteBundle\Tools;

use App\SiteBundle\Tools\GathererCardExtractor;

class GathererSetExtractor
{
    protected $uri = 'http://gatherer.wizards.com';

    protected $cardsQuery = '/Pages/Search/Default.aspx?output=spoiler&method=text&action=advanced&set=|["%s"]';

    protected $set;

    protected $cards;

    public function __construct($set)
    {
        $this->setSet($set);
    }

    public function setSet($set)
    {
        $this->set = $set;
        return $this;
    }

    public function getSet()
    {
        return $this->set;
    }

    public function extract()
    {
        $fetch = sprintf($this->uri.$this->cardsQuery, urlencode($this->getSet()));

        $ch = curl_init($fetch);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $content = curl_exec($ch);
        curl_close($ch);

        preg_match_all('#\<a id="ctl00_ctl00_ctl00_MainContent_SubContent_SubContent_ctl00_cardEntries_ctl\d+_cardLink" class="nameLink" onclick="return CardLinkAction\(event, this, \'SameWindow\'\);" href="../Card/Details.aspx\?multiverseid=(\d+)">(.*)</a>#m', $content, $matches);

        foreach($matches[1] as $id) {
            $this->cards[$id] = new GathererCardExtractor($id);
        }
    }

    public function getCards()
    {
        if (null === $this->cards) {
            $this->extract();
        }
        return $this->cards;
    }



}