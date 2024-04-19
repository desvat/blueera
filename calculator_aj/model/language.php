<?php

/**
 * Model zamówień
 *
 * @author jakubca.com
 */
class kalkulatorHcLanguage
{
 

   
    private $kalkulatorHcLanguage_tablename;
    private $wpdb;
  
    public function __construct()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $this->kalkulatorHcLanguage_tablename = $prefix . "calculator_aj_language";
        $this->wpdb = $wpdb;
       
    }


//Zamowienia
public function getLanguage($nazwa,$default)
    {
        
        // $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = '$id' ORDER BY id DESC;";
        $query = "SELECT * FROM  " . $this->kalkulatorHcLanguage_tablename . " WHERE nazwa = '$nazwa'";
        $tlumaczenie = $this->wpdb->get_row($query);
        if(isset($tlumaczenie->wartosc) && $tlumaczenie->wartosc != ''){
            return $tlumaczenie->wartosc;

        }else{
            return $default;
        }
        // return $settings->wartosc;
    }

    public function getLanguageInCms($nazwa)
    {
        
        // $query = "SELECT * FROM  " . $this->kalkulatorHcZamowienia_tablename . " WHERE id = '$id' ORDER BY id DESC;";
        $query = "SELECT * FROM  " . $this->kalkulatorHcLanguage_tablename . " WHERE nazwa = '$nazwa'";
        $tlumaczenie = $this->wpdb->get_row($query);
        if(isset($tlumaczenie->wartosc)){
            echo $tlumaczenie->wartosc;

        }
        // return $settings->wartosc;
    }

    public function setLanguage($nazwa,$wartosc)
    {
        $query = "SELECT * FROM  " . $this->kalkulatorHcLanguage_tablename . " WHERE nazwa = '$nazwa'";
        $tlumaczenie = $this->wpdb->get_row($query);
        if(isset($tlumaczenie->wartosc)){
            //Add
            
           $this->wpdb->update($this->kalkulatorHcLanguage_tablename, ['wartosc'=>$wartosc], ['nazwa'=>$nazwa]);

        }else{
            
            $this->wpdb->insert($this->kalkulatorHcLanguage_tablename, ['nazwa'=>$nazwa,'wartosc'=>$wartosc]);
            //Update
            

        }
    }

}
