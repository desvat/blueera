<?php
/**
 * Model materialow
 *
 * @author jakubca.com
 */

class kalkulatorHcMaterial {

    private $materialTableName;
    private $materialKsztaltTableName;
    private $wp_calculator_aj_profil_ksztaltProfilu;
    private $wpdb;
 
         public function __construct() {
            global $wpdb;
            $prefix = $wpdb->prefix;
            $this->materialTableName = $prefix . "calculator_aj_material";
            $this->materialKsztaltTableName = $prefix . "calculator_aj_ksztaltProfilu_material";
            $this ->wp_calculator_aj_profil_ksztaltProfilu = $prefix . "calculator_aj_profil_ksztaltProfilu"; 
            $this->wpdb = $wpdb;
    }

    // pobiera wszystkie materialy itp z bazy

    public function getAllMatKolWyk($idProfilu,$idKsztaltuProfilu,$typ) {
        // Wpierw pobiera dane wszystkich materialow i sprawdza czy sa dopisane
        // przeslac identyczna tablice ale dopisac do niej czy jest przypisany czy nie
        // $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'material' OR typ = 'kolor' OR typ = 'wykonczenie' ORDER BY id DESC;";
        // return $this->wpdb->get_results($query, ARRAY_A);
        $tablicaMaterialow = [];
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = '$typ' ORDER BY id;";
        $allmaterials = $this->wpdb->get_results($query, ARRAY_A);
      
        $i=0;
        foreach($allmaterials as $singleMaterial){
            $idMaterialu = $singleMaterial['id'];
              $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE idProfilu = '$idProfilu' AND idKsztaltuProfilu = '$idKsztaltuProfilu' AND idMaterialu = '$idMaterialu' ORDER BY id DESC;";
             $czyIstnieje = $this->wpdb->get_row($query);
             
             if($czyIstnieje == NULL){
                 $przypisany = false;
             }else{
                 $przypisany = true;
             }
             
            $tablicaMaterialow[$i]=[
                'id'=>$singleMaterial['id'],
                'image'=>$singleMaterial['image'],
                'tytul'=> $singleMaterial['tytul'],
                'uniqueText'=> $singleMaterial['uniqueText'],
                'typ' => $singleMaterial['typ'],
                'price' => $singleMaterial['price'],
                'units' => $singleMaterial['units'],
                'caption' => $singleMaterial['caption'],
                'limit' => $singleMaterial['limit'],
                'przypisany' => $przypisany,
            ];
            $i++;
        }



        // return $this->wpdb->get_results($query, ARRAY_A);
        return $tablicaMaterialow;

        // $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE typ = '$typ' ORDER BY id DESC;";
        // return $this->wpdb->get_results($query, ARRAY_A);

    }
    public function materialHasAssigned($idKsztaltu,$idProfilu,$typ){
        $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE idProfilu = '$idProfilu' AND idKsztaltuProfilu = '$idKsztaltu' AND typ = '$typ' ORDER BY id DESC;";
        $czyIstnieje = $this->wpdb->get_row($query);
        return $czyIstnieje;

    }

    public function assignMatKolWyk($idMaterialu,$idKsztaltu,$idProfilu) {
        $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE idProfilu = '$idProfilu' AND idKsztaltuProfilu = '$idKsztaltu' AND idMaterialu = '$idMaterialu' ORDER BY id DESC;";
        $rekordy = $this->wpdb->get_row($query);
        if($rekordy == NULL){
            //pobiera typ
            $query2 = "SELECT * FROM  " . $this->materialTableName . " WHERE id = '$idMaterialu' ORDER BY id DESC;";
            // echo $query2;
            $material = $this->wpdb->get_row($query2);
            $typ = $material->typ;
            // dodaje do bazy
            $data = [
                'idProfilu' => $idProfilu,
                'idKsztaltuProfilu' => $idKsztaltu,
                'idMaterialu' => $idMaterialu,
                'typ' => $typ,
            ];
            $this->wpdb->insert($this->materialKsztaltTableName, $data);
        }
        return $this->wpdb->get_row($query);
    }
    public function assignMatKolWykRemove($idMaterialu,$idKsztaltu,$idProfilu) {

        $this->wpdb->delete( $this->materialKsztaltTableName, array( 'idProfilu' => $idProfilu, 'idKsztaltuProfilu'=>$idKsztaltu,'idMaterialu'=>$idMaterialu ) );
        // $this->wpdb->delete( $this->materialKsztaltTableName, array( 'idProfilu' => $idProfilu, 'idKsztaltuProfilu'=>$idKsztaltu,'idMaterialu'=>$idMaterialu ) );
    }

    public function getAllKonzoly($typ) {

        $tablicaMaterialow = [];
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = '$typ' ORDER BY id;";

        $allmaterials = $this->wpdb->get_results($query, ARRAY_A);
      
        $i=0;
        foreach($allmaterials as $singleMaterial){
            $idMaterialu = $singleMaterial['id'];
              $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE idMaterialu = '$idMaterialu' ORDER BY id DESC;";
             $czyIstnieje = $this->wpdb->get_row($query);
             
             if($czyIstnieje == NULL){
                 $przypisany = false;
             }else{
                 $przypisany = true;
             }
             
            $tablicaMaterialow[$i]=[
                'id'=>$singleMaterial['id'],
                'image'=>$singleMaterial['image'],
                'tytul'=> $singleMaterial['tytul'],
                'uniqueText'=> $singleMaterial['uniqueText'],
                'typ' => $singleMaterial['typ'],
                'price' => $singleMaterial['price'],
                'units' => $singleMaterial['units'],
                'caption' => $singleMaterial['caption'],
                'limit' => $singleMaterial['limit'],
                'przypisany' => $przypisany,
            ];
            $i++;
        }

        return $tablicaMaterialow;

    }

    public function getAllJointsSingle($typ) {

        $tablicaMaterialow = [];
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = '$typ' AND tytul != 'BEZ SPOJOV' ORDER BY id;";

        $allmaterials = $this->wpdb->get_results($query, ARRAY_A);
      
        $i=0;
        foreach($allmaterials as $singleMaterial){
            $idMaterialu = $singleMaterial['id'];
              $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE idMaterialu = '$idMaterialu' ORDER BY id DESC;";
             $czyIstnieje = $this->wpdb->get_row($query);
             
             if($czyIstnieje == NULL){
                 $przypisany = false;
             }else{
                 $przypisany = true;
             }
             
            $tablicaMaterialow[$i]=[
                'id'=>$singleMaterial['id'],
                'image'=>$singleMaterial['image'],
                'tytul'=> $singleMaterial['tytul'],
                'uniqueText'=> $singleMaterial['uniqueText'],
                'typ' => $singleMaterial['typ'],
                'price' => $singleMaterial['price'],
                'units' => $singleMaterial['units'],
                'caption' => $singleMaterial['caption'],
                'limit' => $singleMaterial['limit'],
                'przypisany' => $przypisany,
            ];
            $i++;
        }

        return $tablicaMaterialow;

    }

    public function getAllDoplnky($typ) {

        $tablicaMaterialow = [];
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = '$typ' ORDER BY id;";
        $allmaterials = $this->wpdb->get_results($query, ARRAY_A);
      
        $i=0;
        foreach($allmaterials as $singleMaterial){
            $idMaterialu = $singleMaterial['id'];
              $query = "SELECT * FROM  " . $this->materialKsztaltTableName . " WHERE idMaterialu = '$idMaterialu' ORDER BY id DESC;";
             $czyIstnieje = $this->wpdb->get_row($query);
             
             if($czyIstnieje == NULL){
                 $przypisany = false;
             }else{
                 $przypisany = true;
             }
             
            $tablicaMaterialow[$i]=[
                'id'=>$singleMaterial['id'],
                'image'=>$singleMaterial['image'],
                'tytul'=> $singleMaterial['tytul'],
                'uniqueText'=> $singleMaterial['uniqueText'],
                'typ' => $singleMaterial['typ'],
                'price' => $singleMaterial['price'],
                'units' => $singleMaterial['units'],
                'caption' => $singleMaterial['caption'],
                'limit' => $singleMaterial['limit'],
                'przypisany' => $przypisany,
            ];
            $i++;
        }

        return $tablicaMaterialow;

    }


    public function showAssignMatKolWyk(){
        // dopisac typ do ksztaltProfiluMaterial
        //id profilu
        //id ksztaltu
        //typ
    }
////////////////////////////////////////// KOLORY
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllKolor() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'kolor' ORDER BY id DESC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getColor($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'kolor' AND id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addColor($data){

        $this->wpdb->insert($this->materialTableName, $data);
        
    }
    public function editColor($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);
    }
////////////////////////////////////// KONIEC KOLORÓW






// -------------------------------------------------------------------------------------------------------- Doplnene 2. 10. 2023
////////////////////////////////////////// Endings
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllEndings() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'endings' ORDER BY id DESC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getEndings($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'endings' AND id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addEndings($data){

        $this->wpdb->insert($this->materialTableName, $data);
        
    }
    public function editEndings($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);
    }
////////////////////////////////////////// KONIEC Endings


// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
////////////////////////////////////////// Color Individual
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllColorIndividual() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'kolorIndywidualny' ORDER BY id DESC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getColorIndividual($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'kolorIndywidualny' AND id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addColorIndividual($data){

        $this->wpdb->insert($this->materialTableName, $data);
        
    }
    public function editColorIndividual($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);
    }
////////////////////////////////////////// KONIEC Color Individual

// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
////////////////////////////////////////// Joints
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllJoints() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'joints' ORDER BY id DESC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getJoints($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'joints' AND id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addJoints($data){

        $this->wpdb->insert($this->materialTableName, $data);
        
    }
    public function editJoints($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);
    }
////////////////////////////////////////// KONIEC Joints

// -------------------------------------------------------------------------------------------------------- Doplnene 18. 8. 2023
////////////////////////////////////////// Accessories
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllAccessories() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'kolorAkcesoria' ORDER BY id DESC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getAccessories($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'kolorAkcesoria' AND id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addAccessories($data){

        $this->wpdb->insert($this->materialTableName, $data);
        
    }
    public function editAccessories($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);
    }
////////////////////////////////////////// KONIEC Accessories









    
////////////////////////////////////////// Materiały
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllMaterial() {
      $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'material' ORDER BY id DESC;";
      return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getMaterial($id){
      $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'material' AND id='$id' ORDER BY id DESC;";
      return $this->wpdb->get_row($query);
    }

    public function addMaterial($data){
      $this->wpdb->insert($this->materialTableName, $data);
    }

    public function editMaterial($data,$id){
      $this->wpdb->update($this->materialTableName, $data, $id);
    }
    
////////////////////////////////////// KONIEC Materiałów

////////////////////////////////////////// Materiały
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllWykonczenie() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'wykonczenie' ORDER BY id DESC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }

    public function getWykonczenie($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'wykonczenie' AND id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addWykonczenie($data){

        $this->wpdb->insert($this->materialTableName, $data);
        
    }
    public function editWykonczenie($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);

    }
////////////////////////////////////// KONIEC Materiałów

////////////////////////////////////////// Materiały
/**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllksztaltProfiluAll() {
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'ksztaltProfilu' ORDER BY id DESC;";
        $wszystkiKsztalty = $this->wpdb->get_results($query, ARRAY_A);
        return $wszystkiKsztalty;

    }
    public function getAllksztaltProfilu($idProfilu) {
        // $wp_calculator_aj_profil_ksztaltProfilu
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'ksztaltProfilu' ORDER BY id DESC;";
        $wszystkiKsztalty = $this->wpdb->get_results($query, ARRAY_A);
        $tabelaKsztaltow=[];
        $i=0;
        foreach($wszystkiKsztalty as $ksztalt){
            $idKsztaltu = $ksztalt['id'];
            $query2 = "SELECT * FROM  " . $this->wp_calculator_aj_profil_ksztaltProfilu . " WHERE idProfilu = '$idProfilu' AND idKsztaltuProfilu = '$idKsztaltu' ORDER BY id DESC;";
            if($this->wpdb->get_results($query2, ARRAY_A) == NULL){
                
                $tabelaKsztaltow[$i]=[
                    'id'=> $ksztalt['id'],
                    'image'=> $ksztalt['image'],
                    'tytul'=> $ksztalt['tytul'],
                    'typ'=> $ksztalt['typ'],
                ];
                $i++;
            }else{
                continue;
            }
        }
        
        return $tabelaKsztaltow;
    }

    public function getksztaltProfilu($id){
        $query = "SELECT * FROM  " . $this->materialTableName . " WHERE typ = 'ksztaltProfilu' AND id='$id' ORDER BY tytul DESC;";
        return $this->wpdb->get_row($query);
    }

    // public function addPrzekroj($data){

    //     $this->wpdb->insert($this->materialTableName, $data);
        
    // }

    public function editksztaltProfilu($data,$id){

        $this->wpdb->update($this->materialTableName, $data, $id);

    }

////////////////////////////////////// KONIEC Materiałów

// Do wszystkich


// dostępne dla wszystkich w tabeli
    public function getImageToRemove($id){

       
            $query = "SELECT * FROM  " . $this->materialTableName . " WHERE id='$id' ORDER BY id DESC;";
            return $this->wpdb->get_row($query);
        

    }
    public function remove($id,$return){
    
// !!!!!! dorobić kasowanie kaskadowe ze wszystkimi kombinacjami

        $redirectGetValue = array( 'page' => $return);
        $redirectLink = add_query_arg( $redirectGetValue, admin_url( 'admin.php' ) );
        $imageDeleted = $this -> getImageToRemove($id);
        $imageName = $imageDeleted -> image;
      
        // kasowanie zdjecia
        if($imageName != ''){
            if(file_exists(KHC_PATH.'uploads/'.$imageName)){
               
                unlink(KHC_PATH.'uploads/'.$imageName);
            }
        }
        // kasowanie z bazy
          $this->wpdb->delete( $this->materialTableName, array( 'id' => $id ) );
          $this->wpdb->delete( $this->materialKsztaltTableName, array( 'idMaterialu' => $id ) );
          
        // przekierowanie po usunięciu
           echo '<script>window.location.replace("'.$redirectLink.'");</script>';

    }
}