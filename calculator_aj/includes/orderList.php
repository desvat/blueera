<?php
$zamowienia = new kalkulatorHcZamowienia;
$wszystkieZamowienia = $zamowienia -> getCountOrders();
$ile_zamowien= count($wszystkieZamowienia);

// $data = json_decode($wszystkieZamowienia, true);
// echo '<pre>';
// var_export($wszystkieZamowienia);
// echo '</pre>';

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
if(isset($_GET['naStrone'])){
  if((int)($_GET['naStrone'])>=1){
    $no_of_records_per_page = (int)$_GET['naStrone'];
  }else{
    $no_of_records_per_page = 20;
  }

}else{
  $no_of_records_per_page = 20;
}

$offset = ($pageno-1) * $no_of_records_per_page; 
$total_rows = $ile_zamowien;
$total_pages = ceil($total_rows / $no_of_records_per_page);
if(isset($_GET['status'])){
  $wybranyStatus = $_GET['status'];
}else{
  $wybranyStatus = "all";
}
if(isset($_GET['search'])){
  $search = $_GET['search'];
}else{
  $search = "";
}
if(isset($_GET['orderBy'])){
  $orderBy = $_GET['orderBy'];
  if($orderBy != "ASC" && $orderBy != "DESC"){
    $orderBy = "DESC";
  }
}else{
  $orderBy = "DESC";
}

$wszystkieZamowieniaFromPage = $zamowienia -> getOrders($offset,$no_of_records_per_page,$wybranyStatus,$search,$orderBy);
$statusy = $zamowienia->getStatusy();

?>
<script src="<?php echo KHC_PATH_JQUERY2;?>"></script>
<h3 class="khc_title">Objednávky</h3>
  <form method="GET" id="orderSearch">
    <label for="">Status
    <select name="status" class="form-select" >
        <option value="all" selected>Vyberte stav</option>
        <?php foreach($statusy as $status){
          $selectedStatus = "";
          if(isset($_GET['status'])){
            if($_GET['status'] == $status){
              $selectedStatus = "selected";
            }
          }
            echo '<option value="'.$status.'" '.$selectedStatus.'>'.$status.'</option>';
        }
        ?>
     
    </select>
    </label>
    <label for="">Vyhľadať
    <input type="text" placeholder="Vyhladať..." name="search" value="<?php echo $search;?>">
    </label>
    <label for="">Zoradenie
    <select name="orderBy" class="form-select">
      <option value="all" selected>Triediť</option>
      <option value="DESC">Od najnovšieho</option>
      <option value="ASC">Od najstaršieho</option>
    </select>
    </label>
    <label for="">Počet na stránku
    <input class="naStroneInput" type="number" placeholder="Na stronę" name="naStrone" value="<?php echo $no_of_records_per_page;?>">
    </label>

    <input type="hidden" name="page" value="calculator_aj_zamowienia_subcat_menu">
    <input type="hidden" name="pageno" value="1">
    
    <button class="btn btn-primary">Hľadaj</button>
      
    </form> 
    <script>
      var orderBy = '<?php echo $orderBy;?>';
          if(orderBy == 'ASC' || orderBy == 'DESC'){
            $('select[name="orderBy"]').val(orderBy);
          }
          
    </script>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Meno a priezvisko</th>
      <th scope="col">Firma</th>
      <th scope="col">E-mail</th>
      <th scope="col">Telefón</th>
      <th scope="col">Status</th>
      <th scope="col">Dátum pridania</th>
      <th scope="col">Akcia</th>
    </tr>
  </thead>
  <tbody>
      <?php foreach($wszystkieZamowieniaFromPage as $number => $zamowienie ){
         
          
          $singleOrderGet = array( 'page' => 'calculator_aj_zamowienia_subcat_menu', 'action' => 'showOrder','id' => $zamowienie['id'] );

          ?>

    
    <tr>
      <th scope="row"><?php echo $zamowienie['orderNo'];?></th>
      <td><?php echo $zamowienie['imie'].' '.$zamowienie['nazwisko'];?></td>
      <td><?php echo $zamowienie['nazwaFirmy'];?></td>
      <td><?php echo $zamowienie['email'];?></td>
      <td><?php echo $zamowienie['telefon'];?></td>
      <td><?php echo $zamowienie['status'];?></td>
      <td><?php echo $zamowienie['dataDodania'];?></td>
      <td><a class="buttonShowOrder" href="<?php echo add_query_arg($singleOrderGet, admin_url( 'admin.php' ) ); ?>">Zobraziť</a></td>
    </tr>
    <?php   };?>
   
  </tbody>
</table>
<div class="row"><div class="col-12 pageNumber">  <?php echo $pageno;?>/<?php if($total_pages <=0) {echo "1";}else{echo $total_pages;}?></div></div>
<?php
$uri = $_SERVER['REQUEST_URI'];
?>
<ul class="paginationOrderKHC">
  <?php
      if($pageno > 1){
        $firstPage = array( 'page'=>'calculator_aj_zamowienia_subcat_menu','pageno' => 1);
    ?>
    <li><a href="<?php echo add_query_arg( $firstPage, $uri  );?>">Prvá stránka</a></li>
    <?php
      }
    ?>
    <?php
      if($pageno > 1){
        $previewPage = array( 'page'=>'calculator_aj_zamowienia_subcat_menu','pageno' => $pageno - 1);
    ?>
    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php echo add_query_arg( $previewPage, $uri  );?>">Predchádzajúca stránka</a>
    </li>
    <?php
      }
    ?>
    <?php
      if($pageno < $total_pages){
        $nextPage = array( 'page'=>'calculator_aj_zamowienia_subcat_menu','pageno' => $pageno + 1);
    ?>
    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <!-- <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?page=calculator_aj_zamowienia_subcat_menu&pageno=".($pageno + 1); } ?>">Następna</a> -->
        <a href="<?php echo add_query_arg( $nextPage, $uri  );?>">Nasledujúca stránka</a>
    </li>

    <?php
      }
    ?>
    <?php
      if($pageno < $total_pages){
        $lastPage = array( 'page'=>'calculator_aj_zamowienia_subcat_menu','pageno' => $total_pages);
    ?>
    <li><a href="<?php echo add_query_arg( $lastPage, $uri  );?>">Posledná stránka</a></li>
    <?php
      }
    ?>
</ul>