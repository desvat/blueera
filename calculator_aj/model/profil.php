<?php

/**
 * Model Profili
 *
 * @author jakubca.com
 */
class kalkulatorHcProfil
{
    private $profilTableName;
    private $ProfileKsztaltyProfiliTableName;
    private $materialKsztaltTableName;
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $prefix = $wpdb->prefix;
        $this->profilTableName = $prefix . "calculator_aj_profile";
        $this->ProfileKsztaltyProfiliTableName = $prefix . "calculator_aj_profil_ksztaltProfilu";
        $this->materialKsztaltTableName = $prefix . "calculator_aj_ksztaltProfilu_material";
        $this->wpdb = $wpdb;
    }


    ////////////////////////////////////////// ProfilY
    /**
     * Pobiera wszystkie obrazki
     * @global $wpdb $wpdb
     * @return array Tablica z obrazkami
     */
    public function getAllProfil()
    {
        $query = "SELECT * FROM  " . $this->profilTableName . " ORDER BY id DESC ;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }
    public function getAllVisibleProfil()
    {
        $query = "SELECT * FROM  " . $this->profilTableName . " WHERE roboczy = true ORDER BY ( id = 6 ) DESC, id ASC;";
        return $this->wpdb->get_results($query, ARRAY_A);
    }
    public function getProfil($id)
    {
        $query = "SELECT * FROM  " . $this->profilTableName . " WHERE id='$id' ORDER BY id DESC;";
        return $this->wpdb->get_row($query);
    }

    public function addProfil($data)
    {

        $this->wpdb->insert($this->profilTableName, $data);
        return $lastid = $this->wpdb->insert_id;
    }
    public function editProfil($data, $id)
    {

        $this->wpdb->update($this->profilTableName, $data, $id);
    }


    // relations

    // zwraca wszystkie informacje o przypisanych kształtach do profilu  ID to id profilu
    function khc_showAllAssigned($id)
    {

        $query = "SELECT * FROM  " . $this->ProfileKsztaltyProfiliTableName . " WHERE idProfilu = '$id' ORDER BY id DESC;";
        $assignedShapes = $this->wpdb->get_results($query, ARRAY_A);
        $assignedProfilesShapes = [];
        $profil = new kalkulatorHcMaterial();
        $i = 0;
        foreach ($assignedShapes as $shape) {
            $khcAktualnyKsztalt = $profil->getksztaltProfilu($shape['idKsztaltuProfilu']);
            $assignedProfilesShapes[$i] =
                [
                    'idRelacji' => $shape['id'],
                    'tytul' => $khcAktualnyKsztalt->tytul,
                    'image' => $khcAktualnyKsztalt->image,
                    'idKsztaltu' => $khcAktualnyKsztalt->id,
                    'cena' => $shape['cena'],
                    'widoczny' => $shape['widoczny'],
                ];
            $i++;
        }
        $keys = array_column($assignedProfilesShapes, 'tytul');

		array_multisort($keys, SORT_ASC, $assignedProfilesShapes);
        
     
        return $assignedProfilesShapes;
    }

    // Pobranie danych z relacji ID to id relacji Kształty a profile
    function khc_showAssignedShape($id)
    {
        $query = "SELECT * FROM  " . $this->ProfileKsztaltyProfiliTableName . " WHERE id = '$id' ORDER BY id DESC;";
        $assignedShapes = $this->wpdb->get_row($query);

        return $assignedShapes;
    }
    // usuwanie
// dostępne dla wszystkich w tabeli
public function getImageToRemove($id){

       
    $query = "SELECT * FROM  " . $this->profilTableName . " WHERE id='$id' ORDER BY id DESC;";
    return $this->wpdb->get_row($query);


}
    // public function remove($id, $return)
    public function remove($id)
    {

        // !!!!!! dorobić kasowanie kaskadowe ze wszystkimi kombinacjami

        $redirectGetValue = array('page' => 'calculator_aj_profil_subcat_menu');
        $redirectLink = add_query_arg($redirectGetValue, admin_url('admin.php'));
        $imageDeleted = $this->getImageToRemove($id);
        $imageName = $imageDeleted->image;

        // kasowanie zdjecia
        if ($imageName != '') {
            if (file_exists(KHC_PATH . 'uploads/' . $imageName)) {

                unlink(KHC_PATH . 'uploads/' . $imageName);
            }
        }

        // kasowanie z bazy
        $this->wpdb->delete($this->profilTableName, array('id' => $id));
        $this->wpdb->delete($this->ProfileKsztaltyProfiliTableName, array('idProfilu' => $id));
        $this->wpdb->delete($this->materialKsztaltTableName, array('idProfilu' => $id));

        
        // przekierowanie po usunięciu
        echo '<script>window.location.replace("' . $redirectLink . '");</script>';
    }

    // zwraca wszystkie informacje o ustawienaich w przypisanych kształtach do profilu  ID to id Kształtu profilu w relacji
    public function khc_settingsDataKsztaltProfilu($id)
    {

        $query = "SELECT * FROM  " . $this->ProfileKsztaltyProfiliTableName . " WHERE idKsztaltuProfilu = '$id' ORDER BY id DESC;";
        $Shapes = $this->wpdb->get_row($query);


        $data = $Shapes->data;


        return $data;
    }


 // Dodanie nowego ksztaltu do profilu


 function khc_testAssignedShape($data)
 {
    echo '<pre style="background-color:lightgray;">';
   
        var_export($data);
        // var_dump($data);
     
        // echo json_encode($data)."\n";
      echo '</pre>';
    //  var_dump($data);
     
 }
 function khc_addAssignedShape($data)
 {
    $this->wpdb->insert($this->ProfileKsztaltyProfiliTableName, $data);
    return $lastid = $this->wpdb->insert_id;
     
 }
 function khc_editAssignedShape($data, $id)
 {

     $this->wpdb->update($this->ProfileKsztaltyProfiliTableName, $data, $id);

 }
 function khc_removeAssignedShape($idProfilu, $idRelacji)
 {
    $queryPowrotKsztaltyProfilow = array( 'page' => 'calculator_aj_profil_subcat_menu','do'=>'konfiguruj','id'=>$idProfilu);
    // kasowanie z bazy
    $this->wpdb->delete( $this->ProfileKsztaltyProfiliTableName, array( 'id' => $idRelacji ) );
    // przekierowanie po usunięciu
       echo '<script>window.location.replace("'.add_query_arg( $queryPowrotKsztaltyProfilow, admin_url( 'admin.php' ) ).'");</script>';
       exit();

 }
    //////////////////////////////////Formy 


    public function khc_ProfilParamsForm($data)
    {
        
       
       $buttonAddParametres = '';
        foreach ($data as $title => $value) {
           
            if (isset($value['editable']) && $value['editable'] == true) {
                echo '<h6>' . $value['tytul'] . '</h6>';
                echo '<div class="row">'; // otworzenie wiersza
                // $typ = '';
                
                foreach ($value as $key => $input) {
                    
                    if (isset($value['typ'])) {
                        // $value['typ'] = '';
                        //////////////////////////////////        
                        //Spradzenie typu inputa
                        $typ = $value['typ'];
                        // if ($key == "typ") {
                        //     $typ = $input;
                        // }
                        if (isset($value['tytul'])) {
                            $tytul = $value['tytul'];
                        }else{
                            $tytul = '';
                        }
                        // if ($key == "tytul") {
                        //     $tytul = $input;
                        // }
                        if ($key != "typ" && $key != "tytul" && $key != 'editable') {
                            // kiedy suwak 
                            if ($typ == "number") {
?>
                                
                                <div class="col-md-4">
                                    <label for="<?php echo $title . '-' . $key; ?>" class="form-label"><?php echo $key; ?></label>
                                    <input type="number" min="1" class="form-control" name="<?php echo $title . '-' . $key; ?>" id="<?php echo $title . '-' . $key; ?>" value="<?php echo $input; ?>" required>
                                </div>

<?php       
                            }
                            // wybór
                            if ($typ == "radio") {
                                if($key == 'wartosci'){
                                    echo '<div class="col-12"><div class="row khcOptionEditContainer">';
                                    $countoption = 0;
                                  
                                    if($title=="przekroj"){
                                        $buttonAddParametres = "multiple";
                                    }elseif($title=='gruboscRdzenia'){
                                        $buttonAddParametres = "single";
                                    }else{
                                        $buttonAddParametres = '';
                                    }
                                    foreach($input as $wartosciTitle2 => $wartosci){
                                     
                                        if(is_array($wartosci)){
                                         
                                            //jezeli dalej jest tablica
                                                ?>
                                                        <div class="col-12 khcMultiOptionValue">
                                                        <div class="row khcMultiOptionValueRow">
                                                <?php
                                                  
                                                    foreach($wartosci as $wymiar => $wartoscParametru){
                                                        $i=0;
                                                        if ($wymiar == 'assignedMaterial' || $wymiar == 'assignedMaterialRemove') continue;
                                                        // echo $wymiar;
                                                        ?>
                                                            
                                                                <div class="col-4 mt-2">
                                                                    <input type="number" min="0" step="0.1" class="form-control" name="<?php echo $wymiar . '-' . $key; ?>[]" id="<?php echo $wymiar . '-' . $key; ?>" value="<?php echo $wartoscParametru; ?>">   
                                                                   <!-- <input type="number" min="0" step="0.1" class="form-control" name="<?php echo $wymiar . '-' . $key; ?>[<?php echo $countoption;?>]" id="<?php echo $wymiar . '-' . $key; ?>" value="<?php echo $wartoscParametru; ?>"> -->  
                                                                </div> 
                                                              
                                                            
                                                                
                                                                
                                                                <?php
                                                                $i++;
                                                         if($i == 2){

                                                            $i = 0;
                                                         }
                                                         
                                                    }
                                                    ?>
                                                      <div class="col-4 mt-2"> 
                                                                     <button type="button" class="btn btn-secondary khcMultiOptionRemove mt-3">Odstrániť</button>  
                                                       </div> 
                                                    </div>
                                                    </div>

                                            <?php

                                        }else{
                                           
                                            //jezeli juz nie jest tablica
                                            ?>
                                            <div class="col-12 khcSingleOptionValue">
                                                <div class="row khcSingleOptionValueRow">
                                                    <div class="col-4 mt-2">
                                                        <!-- <input type="number" min="0" step="0.1" class="form-control" name="<?php echo $title . '-' . $key; ?>[<?php echo $countoption;?>]" id="<?php echo $title . '-' . $key; ?>" value="<?php echo $wartosci; ?>">  --> 
                                                        <input type="number" min="0" step="0.1" class="form-control" name="<?php echo $title . '-' . $key; ?>[]" id="<?php echo $title . '-' . $key; ?>" value="<?php echo $wartosci; ?>">   
                                                    </div> 
                                                    <div class="col-4 mt-2"> 
                                                         <button type="button" class="btn btn-secondary khcSingleOptionRemove mt-3">Odstrániť</button>  
                                                    </div> 
                                                </div>
                                            </div>
                                            <?php
                                           $countoption ++;
                                        }
                                        
                                    }
                                  
                                    echo '</div>';
                                   
                                    echo '<div class="col-12"><button type="button" class="khcOptionEditAdd mt-3 btn btn-success">Pridať</button></div>';
                                    echo '</div>';
                                }

                            }
                        }

                        //////////////////////////////////
                    }
                }

                echo '</div><hr>'; // zamkniecie wiersza
                ?>
               
                    
                <?php
            }
        }
?>
 <script>
                   $( document).on('click','.khcSingleOptionRemove',function() {
                        $(this).closest('.khcSingleOptionValue').remove();
                    });
                    $( ".khcOptionEditAdd").click(function() {
                        $buttonSwith = '<?php echo $buttonAddParametres;?>';
                        if($buttonSwith == "single"){
                        var appendRadioChoise ='' 
                        +'<div class="col-12 khcSingleOptionValue">' 
                        +' <div class="row khcSingleOptionValueRow">' 
                        +' <div class="col-4 mt-2">' 
                        +'  <input type="number" min="0" step="0.1" class="form-control" name="gruboscRdzenia-wartosci[]" id="gruboscRdzenia-wartosci" value="5">'    
                        +'   </div>'  
                        +'  <div class="col-4 mt-2">'  
                        +'      <button type="button" class="btn btn-secondary khcSingleOptionRemove mt-3">Odstrániť</button>'   
                        +'  </div>'  
                        +'  </div>' 
                        +'  </div>' ;
                        }
                        else  if($buttonSwith == "multiple"){
                            var appendRadioChoise ='' 
                            +'<div class="col-12 khcMultiOptionValue">' 
                            +' <div class="row khcMultiOptionValueRow">' 
                            +' <div class="col-4 mt-2">' 
                            +'  <input type="number" min="0" step="0.1" class="form-control" name="dlugosc-wartosci[]" id="dlugosc-wartosci" value="10">'    
                            +'   </div>'
                            +' <div class="col-4 mt-2">' 
                            +'  <input type="number" min="0" step="0.1" class="form-control" name="szerokosc-wartosci[]" id="szerokosc-wartosci" value="10">'    
                            +'   </div>'   
                            +'  <div class="col-4 mt-2">'  
                            +'      <button type="button" class="btn btn-secondary khcMultiOptionRemove mt-3">Odstrániť</button>'   
                            +'  </div>'  
                            +'  </div>' 
                            +'  </div>' ;
                          
                        }
                        $( ".khcOptionEditContainer" ).append( appendRadioChoise );
                    });
                    $( document).on('click','.khcMultiOptionRemove',function() {
                        $(this).closest('.khcMultiOptionValue').remove();
                    });
                    
                </script>
<?php


    }
}






?>