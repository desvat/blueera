<?php
$zamowienia = new kalkulatorHcZamowienia;
$ustawienia = new kalkulatorHcSettings;

$waluta = $ustawienia -> getSettings('waluta');
$miejsceWaluty = $ustawienia -> getSettings('miejsceWaluty');
$konfiguracjaWalutaRight = "";
$konfiguracjaWalutaLeft = "";
if($miejsceWaluty == 'right'){
  $konfiguracjaWalutaRight = $waluta;
  $konfiguracjaWalutaLeft = "";
}
if($miejsceWaluty == 'rightSpace'){
  $konfiguracjaWalutaRight = ' '.$waluta;
  $konfiguracjaWalutaLeft = "";
}
if($miejsceWaluty == 'left'){
  $konfiguracjaWalutaLeft = $waluta;
  $konfiguracjaWalutaRight="";
}
if($miejsceWaluty == 'leftSpace'){
  $konfiguracjaWalutaLeft = $waluta.' ';
  $konfiguracjaWalutaRight="";
}

if (isset($_GET['id'])) {
  $idZamowienia = $_GET['id'];
}

if(isset($_POST['notatka']) && isset($_POST['status'])){

  $data = [
    'notatka' => $_POST['notatka'],
    'status'=> $_POST['status']
  ];
  $id = [
    'id' => $idZamowienia
  ];
  $zamowienia -> updateOrder($data,$id);
  $komunikatAktualizacja = "Zaktualizowano pomyślnie!";
}

$SingleOrder = $zamowienia->getOrder($idZamowienia);

$produktyJson = $SingleOrder->produkty;
$produkty = json_decode($produktyJson, true);
echo "<pre>";
var_export($produkty);
echo "</pre>";
$statusy = $zamowienia->getStatusy();
?>

<h3 class="khc_title">Objednávka</h3>
<h4 class="khc_title khc_dane">Fakturačné údaje</h4>

<div class="row orderDate">
  <div class="col-md-6">

 
    <div class="row">
      <div class="col-6 orderValueTitle">Meno</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->imie; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Priezvisko</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->nazwisko; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">E-mail</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->email; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Telefón</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->telefon; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Ulica</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->ulica; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Mesto</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->miasto; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">PSČ</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->kodPocztowy; ?></div>
    </div>
    <!--  -->
    <hr>
    <div class="row">
      <div class="col-6 orderValueTitle">Poznámka</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->poznamka; ?></div>
    </div>
    <hr>
    <!--  -->
    <div class="row mt-3 mb-3">
      <div class="col-6 orderValueTitle">Iná adresa doručenia</div>
      <!-- <div class="col-6 orderValue"><?php echo $SingleOrder->ulicaInne; ?></div> -->
    </div>

    <div class="row">
      <div class="col-6 orderValueTitle">Ulica</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->ulicaInne; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Mesto</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->miastoInne; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">PSČ</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->kodPocztowyInne; ?></div>
    </div>
    <hr>
    <!--  -->
    <div class="row">
      <div class="col-6 orderValueTitle">Názov firmy</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->nazwaFirmy; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">IČO</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->nip; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Krajina</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->kraj; ?></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle">Dátum pridania</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->dataDodania; ?></div>
    </div>

    <div class="row">
      <div class="col-6 orderValueTitle">Správa</div>
      <div class="col-6 orderValue"><?php echo $SingleOrder->wiadomosc; ?></div>
    </div>
  </div>
  <div class="col-md-6">
     <!--  -->
     <form method="POST">
     <div class="row">
       <?php if(isset($komunikatAktualizacja)){ ?>
       <div class="col-12 mb-3"><span style="color:green;"><?php echo $komunikatAktualizacja;?></span></div>
       <?php } ?>
      <div class="col-4 orderValueTitle">Status</div>
      <div class="col-8 orderValue">
        <select class="form-select mb-3 inputOrderShow" name="status">
          <option value="<?php echo $SingleOrder->status; ?>" selected><?php echo $SingleOrder->status; ?></option>
          <?php foreach ($statusy as $status) {
            if ($status != $SingleOrder->status) {
              echo '<option value="' . $status . '">' . $status . '</option>';
            }
          }
          ?>

        </select>


      </div>
    </div>
    <div class="row">
      <div class="col-4 orderValueTitle">Poznámka</div>
      <div class="col-8 orderValue"><textarea name="notatka" class="inputOrderShow"><?PHP echo $SingleOrder->notatka;?></textarea></div>
    </div>
    <div class="row">
      <div class="col-6 orderValueTitle"><button class="btn btn-primary">Aktualizovať</button></div>
      
    </div>
    </form>
<!--  -->
  </div>
</div>
<h4 class="khc_title khc_dane">Produkty</h4>

<div class="row SingleUserOrderList">
<?php 

$sumaNettoWszystkie = 0;
$sumaBruttoWszystkie = 0;
?>
  <?php 
    foreach ($produkty as $numer => $produkt) {
      
      // echo "<pre>";
      // var_export($produkt);
      // echo "</pre>";

      $sumaWszystkieNetto += $produkt['cennik']['cenaZaWszystkieNetto'];
      $sumaWszystkieBrutto +=$produkt['cennik']['cenaZaWszystkieBrutto'];
    
      if($produkt['slugKsztaltu'] == 'doplnky'){
        global $wpdb;
        $doplnokId = $produkt['request']['doplnok-id'];
        $result = $wpdb->get_row("SELECT tytul, price, units FROM iltlll_calculator_aj_material WHERE ID = $doplnokId");
      ?>
      <div class="col-12 singleOrderProduct mb-5">
        <div class="row">
          <div class="col-12 mb-3">
            <h5><?php echo $result->tytul; ?><h5>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h6>Cena<h6>
          </div>
          <div class="col-md-6">
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">s DPH</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Cena za kus</th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaSztukeNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                  <tr>
                    <th scope="row">Cena spolu</th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaWszystkieNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-12">
                <h6>Konfigurácia<h6>
              </div>
              <div class="col-6">Počet kusov</div>
              <div class="col-6"><?php echo $produkt['request']['doplnok-count']; ?> ks</div>
            </div>
          </div>
        </div>
      </div>

      <?php
        }
        elseif($produkt['slugKsztaltu'] == 'konzoly'){
          global $wpdb;
          $konzolyId = $produkt['request']['konzoly-id'];
          $result = $wpdb->get_row("SELECT tytul, price, units FROM iltlll_calculator_aj_material WHERE ID = $konzolyId");
      ?>
      <div class="col-12 singleOrderProduct mb-5">
        <div class="row">
          <div class="col-12 mb-3">
            <h5><?php echo $result->tytul; ?><h5>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h6>Cena<h6>
          </div>
          <div class="col-md-6">
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">s DPH</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Cena za kus</th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaSztukeNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                  <tr>
                    <th scope="row">Cena spolu</th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaWszystkieNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-12">
                <h6>Konfigurácia<h6>
              </div>
              <div class="col-6">Počet kusov</div>
              <div class="col-6"><?php echo $produkt['request']['konzoly-count']; ?> ks</div>
            </div>
          </div>
        </div>
      </div>


      <?php
      } else {
      ?>
  
      <div class="col-12 singleOrderProduct mb-5">
        <div class="row">
          <div class="col-12 mb-3">
            <h5><?php echo $produkt['ksztalt']; ?><h5>
          </div>
        </div>


        <div class="row">
          <div class="col-12">
            <h6>Cena<h6>
          </div>
          <div class="col-md-6">
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">s DPH</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">Cena za meter<sup>2</sup></th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaMetrNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                  <tr>
                    <th scope="row">Cena za kus</th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaSztukeNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                  <tr>
                    <th scope="row">Cena spolu</th>
                    <td><?php echo $konfiguracjaWalutaLeft;?><?php echo $produkt['cennik']['cenaZaWszystkieNetto']; ?><?php echo $konfiguracjaWalutaRight;?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-12">
                <h6>Konfigurácia<h6>
              </div>
              <div class="col-6">Počet kusov</div>
              <div class="col-6"><?php echo $produkt['request']['liczbaSztuk']; ?> ks</div>
              <div class="col-6">Koľko metrov<sup>2</sup></div>
              <div class="col-6"><?php echo $produkt['cennik']['ileCenymetrowKwadratowych']; ?> m<sup>2</sup></div>
              <?php if (isset($produkt['nazwyMaterialow']['kolor'])) {; ?>
                <div class="col-6">Farby štandardné</div>
                <div class="col-6"><?php echo $produkt['nazwyMaterialow']['kolor']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['nazwyMaterialow']['kolorColorIndividual'])) {; ?>
                <div class="col-6">Farby špeciálne</div>
                <div class="col-6"><?php echo $produkt['nazwyMaterialow']['kolorColorIndividual']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['nazwyMaterialow']['joints'])) {; ?>
                <div class="col-6">Spoje</div>
                <div class="col-6"><?php echo $produkt['nazwyMaterialow']['joints']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['request']['accessoriesCount'])) {; ?>
                <div class="col-6">Doplnky</div>
                <div class="col-6"><?php echo $produkt['request']['accessoriesCount']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['nazwyMaterialow']['accessoriesCount'])) {; ?>
                <div class="col-6">Test</div>
                <div class="col-6"><?php echo $produkt['request']['akcesoriaTitle-1']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['nazwyMaterialow']['material'])) {; ?>
                <div class="col-6">Vzor dreva</div>
                <div class="col-6"><?php echo $produkt['nazwyMaterialow']['material']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['nazwyMaterialow']['wykonczenie'])) {; ?>
                <div class="col-6">Hrany</div>
                <div class="col-6"><?php echo $produkt['nazwyMaterialow']['wykonczenie']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['request']['dlugosc'])) {; ?>
                <div class="col-6">Dĺžka</div>
                <div class="col-6"><?php echo $produkt['request']['dlugosc']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['szerokosc'])) {; ?>
                <div class="col-6">Šírka</div>
                <div class="col-6"><?php echo $produkt['request']['szerokosc']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['wysokosc'])) {; ?>
                <div class="col-6">Výška</div>
                <div class="col-6"><?php echo $produkt['request']['wysokosc']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['wysokoscA'])) {; ?>
                <div class="col-6">Výška A</div>
                <div class="col-6"><?php echo $produkt['request']['wysokoscA']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['wysokoscB'])) {; ?>
                <div class="col-6">Výška B</div>
                <div class="col-6"><?php echo $produkt['request']['wysokoscB']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['gruboscRdzenia'])) {; ?>
                <div class="col-6">Hrúbka jadra</div>
                <div class="col-6"><?php echo $produkt['request']['gruboscRdzenia']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['przekroj'])) {; ?>
                <div class="col-6">Prierez</div>
                <div class="col-6"><?php echo $produkt['request']['przekroj']; ?>cm</div>
              <?php } ?>
              <?php if (isset($produkt['request']['dodatkoweZaslepki'])) {; ?>
                <div class="col-6">Ukončenia</div>
                <div class="col-6"><?php echo $produkt['request']['dodatkoweZaslepki']; ?></div>
              <?php } ?>
              <?php if (isset($produkt['request']['dodatkowaOzdobnaScianka'])) {; ?>
                <div class="col-6">Dodatočná dekoratívna stena</div>
                <div class="col-6">Áno</div>
              <?php } ?>
              <?php if (isset($produkt['request']['dodatkoweOzdobneKrawedzie'])) {; ?>
                <div class="col-6">Ďalšie ozdobné hrany</div>
                <div class="col-6">Áno</div>
              <?php } ?>
              <?php 
                global $wpdb;
                $akcesoriaCounts = array();

                foreach ($produkt['request'] as $key => $value) {
                  // Skontrolujeme, či názov kľúča začína "akcesoriaCount-"
                  if (strpos($key, 'akcesoriaCount-') === 0) {
                      // Extrahujeme číslo (napr. 426) zo začiatku kľúča
                      $accessoryId = substr($key, strlen('akcesoriaCount-'));
                      // Priradíme hodnotu k danému kľúču v poli $akcesoriaCounts
                      $akcesoriaCounts[$accessoryId] = $value;
                  }
                }

                foreach ($akcesoriaCounts as $accessoryId => $count) {

                  $result = $wpdb->get_row("SELECT tytul, price, units FROM iltlll_calculator_aj_material WHERE ID = $accessoryId");

                  echo "<div class='col-6'>" . $result->tytul . "</div>";
                  echo "<div class='col-3'>" . $count . " ks</div>";
                  echo "<div class='col-3'>" . $result->price . " €</div>";

                }
                  
                ?>
            </div>
          </div>




      </div>

    </div>

  <?php
      }
    }
  ?>

        <div class="col-12 mb-3">
          <h5>Zhrnutie</h5>
          <h6 class="mt-3">Suma s DPH: <?php echo $konfiguracjaWalutaLeft;?><?php echo $sumaWszystkieNetto;?><?php echo $konfiguracjaWalutaRight;?></h6>
        </div>

</div>