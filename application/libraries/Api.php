<?php

if (! defined('BASEPATH')) exit('No direct script access');

class Api 
{
    private $_uri;

    public function setUri($uri)
    {
        $this->_uri = $uri;
        
        return $this;
    }
    
    public function getGames()
    {
        return json_decode(file_get_contents($this->_uri.'get_games'));
    }
    
    public function getGameIds()
    {
        $result = json_decode(file_get_contents($this->_uri.'get_game_ids'));
        
        if (!$result) return false;
        
        $return = array();
        
        foreach ($result as $r) {
            $return[] = $r->id;
        }
        
        return $return;
    }
}
