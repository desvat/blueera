
<?php
    // if (isset($_SESSION['KHCkoszyk'])) {
    //     $obsahKoszyku = $_SESSION['KHCkoszyk'];
    //     echo "<pre>";
    //         var_dump($obsahKoszyku);
    //     echo "</pre>";
    // } else {
    //     echo "Proměnná KHCkoszyk v SESSION neexistuje nebo je prázdná.";
    // }


    // if (isset($_SESSION['KHCkoszyk'])) {
    //     $obsahKoszyku = $_SESSION['KHCkoszyk'];
    
    //     foreach ($obsahKoszyku as $index => $polozka) {
    //         $cennik = $polozka['cennik'];
    
    //         echo "<br>";
    //         echo "<h4>Pole $index</h4>";
    //         echo "<pre>";
    //         var_dump($cennik);
    //         echo "</pre>";
    //     }
    // } else {
    //     echo "Proměnná KHCkoszyk v SESSION neexistuje nebo je prázdná.";
    // }

?>


<?php
// MENU 
displayMenu();
function displayMenu()
{
    $uri = $_SERVER['REQUEST_URI'];
    $koszykLink = array('action' => 'koszyk');
    $homeLink = array('action' => 'home');
    $zamowieniaKoszyk = new kalkulatorHcZamowienia;
    $lang = new kalkulatorHcLanguage;
    $koszyk1 = $zamowieniaKoszyk->getCard();
    if ($koszyk1 == NULL) {
        $zamowieniaKoszyk->createCard();
        $koszyk1 = $zamowieniaKoszyk->getCard();
    }

?>
    <div class="row">
        <?php if (isset($_GET['action'])) {
            if ($_GET['action'] == "home") {
        ?>
                <div class="col-md-12 cardIconContainer"><a href="<?php echo add_query_arg($koszykLink, $uri); ?>"><?php echo $lang->getLanguage('koszykKalkulatora', 'Koszyk kalkulatora'); ?><img class="cardIcon" src="<?php echo KHC_PATH2 . 'icons/shopping-cart.svg' ?>" alt=""><span class="cartCountMenu"><?php echo count($koszyk1); ?></span></a></div>
            <?php
            } else {
            ?>

                <div class="col-md-12 cardIconContainer"><a href="<?php echo "/kosik/?action=koszyk&id=" . $_GET['id']; ?>"><?php echo $lang->getLanguage('koszykKalkulatora', 'Koszyk kalkulatora'); ?><img class="cardIcon" src="<?php echo KHC_PATH2 . 'icons/shopping-cart.svg' ?>" alt=""><span class="cartCountMenu"><?php echo count($koszyk1); ?></span></a></div>
            <?php
            }

            ?>


        <?php
        } else { ?>

            <div class="col-md-12 cardIconContainer"><a href="<?php echo "/kosik/?action=koszyk"; ?>"><?php echo $lang->getLanguage('koszykKalkulatora', 'Koszyk kalkulatora'); ?><img class="cardIcon" src="<?php echo KHC_PATH2 . 'icons/shopping-cart.svg' ?>" alt=""><span class="cartCountMenu"><?php echo count($koszyk1); ?></span></a></div>
        <?php
        } ?>

    </div>


<?php
    // END MENU
}

// Wybór kategorii profilu
function displayStepOne()
{

    $profile = new kalkulatorHcProfil;
    $widoczneProfile = $profile->getAllVisibleProfil();



?>


    <div class="row stepOneContainer">
        <!--  -->

        <?php

        foreach ($widoczneProfile as $profil) {

        ?>
            <div class="col-12 f-single-profile-box">
                <div class="row">
                    
                    <div class="col-12 f-single-profile" style="">
                        <div class="row">
                            <div class="col-lg-7 single-profile-text-f">
                                <div class="row">
                                    <div class="col-md-12 f-single-profile-title">
                                        <h3><?php echo $profil['tytul']; ?></h3>
                                    </div>
                                    <div class="col-md-8">
                                        <p><?php echo $profil['opis']; ?></p>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-5 f-single-profile-img">
                                <img class="img-front-profile-panel" src="<?php echo KHC_PATH2 . 'uploads/' . $profil['image']; ?>" alt="">
                            </div>
                        </div>
                        <div class="col-12 f-assigned-shape">
                            <div class="row">
                                <?php
                                $materialModel = new kalkulatorHcMaterial();

                                $idProfilu = (int)$profil['id'];
                                $assignedShape = $profile->khc_showAllAssigned($idProfilu);

                                // do kazdego elementu w pętli
                                foreach ($assignedShape as $shape) {
                                    //$idProfilu
                                    $idKsztaltu = (int)$shape['idKsztaltu'];
                                    $HasColor = $materialModel->materialHasAssigned($idKsztaltu, $idProfilu, 'kolor');
                                    $HasMaterial = $materialModel->materialHasAssigned($idKsztaltu, $idProfilu, 'material');
                                    $HasWykonczenie = $materialModel->materialHasAssigned($idKsztaltu, $idProfilu, 'wykonczenie');
                                    
                                    $HaskolorIndywidualny = $materialModel->materialHasAssigned($idKsztaltu, $idProfilu, 'kolorIndywidualny'); // Add
                                    $HaskolorAkcesoria = $materialModel->materialHasAssigned($idKsztaltu, $idProfilu, 'kolorAkcesoria'); // Add


                                    if ($HasColor == NULL) continue;
                                    if ($HasMaterial == NULL) continue;
                                    if ($HasWykonczenie == NULL) continue;

                                    if ($HaskolorIndywidualny == NULL) continue; // Add
                                    if ($HaskolorAkcesoria == NULL) continue; // Add

                                    if ($shape['widoczny'] == false) continue;
                                    $idRelacji = (int)$shape['idRelacji'];
                                    $konfiguracjaLink = array('action' => 'konfiguracja', 'id' => $idRelacji);
                                    $uri = $_SERVER['REQUEST_URI'];
                                ?>


                                    <div class="col-md-4 f-single-shape-assigned">
                                        <a href="<?php echo add_query_arg($konfiguracjaLink, $uri); ?>"><img src="<?php echo KHC_PATH2 . 'uploads/' . $shape['image']; ?>" class="img-fluid" alt="">
                                            <div class="f-single-shape-title"><?php echo $shape['tytul']; ?></div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                </div>

            <?php
        }
            ?>
            <!--  -->

            
            </div>
            <script>
                $('.f-single-profile').click(function() {
                    if ($(this).hasClass('widoczne')) {
                        $(this).removeClass('widoczne');
                        $(this).parent().find('.f-assigned-shape').fadeOut();
                    } else {
                        $(this).addClass('widoczne');
                        $(this).parent().find('.f-assigned-shape').fadeIn();

                    }


                });
            </script>
        <?
    }


    //// zarzadzanie kształtem

    function displayShape()
    {

        require_once 'konfiguratorfront.php';
    }


    //// zarzadzanie koszykiem

    function khc_displayShoppingCard()
    {

        require_once 'card.php';
    }

    //// zarzadzanie koszykiem

    function khc_displayOrderForm()
    {

        require_once 'orderForm.php';
    }
    function khc_success()
    {
        require_once 'success.php';
    }
    function doplnky_show()
    {
        require_once 'doplnky.php';
    }
    // koniec wyboru profilu

    $availableAction = [
        'konfiguracja', 'koszyk', 'home', 'zamowienie', 'success', 'doplnky'
    ];

    // takie wartosci trzeba getem sterować
    if (isset($_GET['action']) && in_array($_GET['action'], $availableAction)) {

        switch ($_GET['action']) {
            case 'konfiguracja':
                displayShape();
                break;
            case 'koszyk':
                khc_displayShoppingCard();
                break;
            case 'home':
                displayStepOne();
                break;
            case 'zamowienie':
                khc_displayOrderForm();
                break;
            case 'success':
                khc_success();
                break;
            case 'doplnky':
                doplnky_show();
                break;
        }
    } else {
        displayStepOne();
    }
        ?>