<?php
$profil = new kalkulatorHcProfil();
$ustawienia = new kalkulatorHcSettings;
$waluta = $ustawienia -> getSettings('waluta');
if (isset($_GET['id'])) {
    $idprofilu = $_GET['id'];
}

if(isset($_POST['submit']) && isset($_POST['remove'])){
    $profil -> remove($idprofilu);
    exit();
}

$aktualnyProfil = $profil->getProfil($idprofilu);
$editTitleGet = array('page' => 'calculator_aj_profil_subcat_menu', 'do' => 'add', 'step' => '1', 'action' => 'edit', 'id' => $idprofilu);
$addKsztaltGet = array('page' => 'calculator_aj_profil_subcat_menu', 'do' => 'addksztalt', 'id' => $idprofilu);

$przypisaneKsztalty = $profil->khc_showAllAssigned($idprofilu);

// var_dump($przypisaneKsztalty);


if (isset($_POST['roboczy'])) {
    if ($_POST['roboczy'] == 0) {
        $profil->editProfil(['roboczy' => false], ['id' => $idprofilu]);
    }
    if ($_POST['roboczy'] == 1) {
        $profil->editProfil(['roboczy' => true], ['id' => $idprofilu]);
    }
    $aktualnyProfil = $profil->getProfil($idprofilu);
    // poprawic wczytanie
}
$roboczy = $aktualnyProfil->roboczy;
?>

<div class="row">
    <div class="col-md-7">
        <h4><?php echo $aktualnyProfil->tytul; ?></h4>
        <p><?php echo $aktualnyProfil->opis; ?></p>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="col-6">
                <?php if ($roboczy == 0) { ?>
                    <form method="POST">
                        <input type="hidden" name="roboczy" value="1">
                        <button class="btn btn-success">Publikovať</button>

                    </form>
                <?php } ?>
                <?php if ($roboczy == 1) { ?>
                    <form method="POST">
                        <input type="hidden" name="roboczy" value="0">
                        <button class="btn btn-secondary">Aktivácia pracovnej verzie</button>

                    </form>
                <?php } ?>
            </div>
            <div class="col-6">
                <button id="btn-delete" class="btn btn-danger">Odstrániť</button>
            </div>
        </div>
    </div>
</div>

<div class="row mt-3">
    <div class="col-12">
        <a class="btn btn-success" href="<?php echo add_query_arg($editTitleGet, admin_url('admin.php')); ?>">Upraviť</a>
        <a class="btn btn-success" href="<?php echo add_query_arg($addKsztaltGet, admin_url('admin.php')); ?>">Pridať tvar</a>

    </div>
</div>
<div class="row mt-5">

    <?php foreach ($przypisaneKsztalty as $ksztalt) {
        // tutaj chyba trzeba odwolanie do relacji a nie do ksztaltu
        $editKsztaltGet = array('page' => 'calculator_aj_profil_subcat_menu', 'do' => 'editksztalt', 'id' => $ksztalt['idRelacji']);
        $widoczny = $ksztalt['widoczny'];
        if ($widoczny == true) {
            $czy_widoczny = '';
        } else {
            $czy_widoczny = 'ukrytyKsztalt';
        }
    ?>
        <!-- idKsztaltu -->
        <div class="col-md-3 khc-conf-tile">
            <a href="<?php echo add_query_arg($editKsztaltGet, admin_url('admin.php')); ?>">
                <div class="row">
                    <div class="col-12"><img src="<?php echo KHC_PATH2 . 'uploads/' . $ksztalt['image']; ?>" class="img-fluid <?php echo $czy_widoczny; ?>" alt=""></div>
                </div>
                <div class="row">
                    <div class="col-12"><?php echo $ksztalt['tytul']; ?></div>
                </div>
                <div class="row">
                    <div class="col-12">Cena: <?php echo number_format((float)$ksztalt['cena'], 2, '.', ''); ?> <?php echo $waluta;?>/m<sup>2</sup></div>
                </div>
            </a>
        </div>
       
       


    <?php
    } ?>


</div>

<style>
            .modal {
                display: none;
                position: fixed;
                z-index: 1;
                padding-top: 100px;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgb(0, 0, 0);
                background-color: rgba(0, 0, 0, 0.4);
            }


            .modal-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 60%;
            }


            .close {
                color: #aaaaaa;
                text-align: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: #000;
                text-decoration: none;
                cursor: pointer;
            }

            .btn-danger {
                color: white !important;
            }
        </style>
        <!-- The Modal -->
        <div id="modal-delete" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <form method="POST">
                    <p>Ste si istí, že chcete túto konfiguráciu natrvalo odstrániť?</p>
                    <input type="hidden" name="remove" value="<?php echo $idprofilu; ?>">
                    <p><button name="submit" class="btn btn-danger">Odstrániť</button></p>
                </form>
            </div>

        </div>
<script>
          
          var modal = document.getElementById("modal-delete");
          var btn = document.getElementById("btn-delete");
          var span = document.getElementsByClassName("close")[0];
          btn.onclick = function() {
             
              modal.style.display = "block";
          }
          span.onclick = function() {
              modal.style.display = "none";
          }
          window.onclick = function(event) {
              if (event.target == modal) {
                  modal.style.display = "none";
              }
          }
      </script>