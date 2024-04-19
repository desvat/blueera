<?php

/**
 * Model zamówień
 *
 * @author jakubca.com
 */
class kalkulatorHcSettings
{
 

   
    private $kalkulatorHcSettings_tablename;
    private $wpdb;
  
    public function __construct()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $this->kalkulatorHcSettings_tablename = $prefix . "calculator_aj_settings";
        $this->wpdb = $wpdb;
       
    }


//Zamowienia


    public function getSettings($nazwa)
    {
        
        // $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = '$id' ORDER BY id DESC;";
        $query = "SELECT * FROM  " . $this->kalkulatorHcSettings_tablename . " WHERE nazwa = '$nazwa'";
        $settings = $this->wpdb->get_row($query);

        return $settings->wartosc;
    }

    public function setSettings($data, $nazwa)
    {

        $this->wpdb->update($this->kalkulatorHcSettings_tablename, $data, $nazwa);
    }

}
