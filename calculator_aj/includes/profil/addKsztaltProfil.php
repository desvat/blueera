<?php
    $material = new kalkulatorHcMaterial();
    if(isset($_GET['id'])){
        $idProfilu = $_GET['id'];
    }
    $khcAllksztaltProfilu = $material->getAllksztaltProfilu($idProfilu);
  
  
    ?>
    <a class="khc_powrot mb-3" href="/wp-admin/admin.php?page=calculator_aj_profil_subcat_menu&do=konfiguruj&id=<?php echo $idProfilu;?>">< Späť</a>
    <table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Fotografia</th>
        <th scope="col">Názov</th>
        <th scope="col"></th>

        </tr>
    </thead>
<tbody>
    <?php
    
     $i = 1;
    foreach($khcAllksztaltProfilu as $ksztaltProfilu){
        $query_args = array( 'page' => 'calculator_aj_profil_subcat_menu', 'do' => 'assignShape','id'=>$idProfilu,'idKsztaltu'=>$ksztaltProfilu['id'] );
       
       ?>
       <!-- Trzeba dodac sluga do linku zeby jakos odroznic -->
            <tr>
            <th scope="row"><?php echo $i;?></th>
            <td style="width:20%"><img src="<?php echo KHC_PATH2.'uploads/'.$ksztaltProfilu['image']; ?>" class="img-fluid" alt=""></td>
            <td><?php echo $ksztaltProfilu['tytul'];?></td>
            <td><a class="btn btn-secondary" href="<?php echo add_query_arg( $query_args, admin_url( 'admin.php' ) );?>">Pridať</a></td>
            </tr>
        <?php
        $i++;
    }
    if(count($khcAllksztaltProfilu) == 0){
        echo '<div class="mt-3 mb-3" style="color:gray;">Už ste pridali všetky tvary.</div>';
    }
    ?>
   
</tbody>
</table>

    <?php 



?>

