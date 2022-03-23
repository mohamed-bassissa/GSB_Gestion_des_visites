<?php
session_start();

require('src/connectionpdo.php');

//requette pour afficher les médecines 

$reqMedecins = $db->query('SELECT * FROM medecin ');


if (isset($_GET['medecin'])) {
    $infoMedecin = $_GET['medecin'];  
}
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>informations des médecins</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style>
      .hidden{
          display: none;
      }
      .img-thumbnail{
        max-width: 20%;
        border: none;
        margin-left: 15px;
      }
</style>
</head>
<body>
    <!-- navbar -->
    <main>
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="accueill.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4 bleu"><img src="img/logo_gsb.webp" class="img-thumbnail" alt=""></span>
            </a>
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link "  href="accueill.php">accueill</a></li>
                <li class="nav-item dropdown"><a class="nav-link " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-current="page">Gérer mes rapports de visite</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="creeRapport.php">créer un nouveau rapport </a></li>
                    <li><a class="dropdown-item" href="modifierRapport.php">modifier un rapport</a></li>                               
                </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-current="page">Gérer mes médecins</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="infoMedecins.php">informations des médecins</a></li>                              
                </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="seDeconecter.php">Se Déconecter</a></li>
            </ul> 
        </header>
    </main> 
        <!-- end navbar -->
    <div class="text-center">
        <h1 class="display-4">informations des médecins</h1>        
    </div> 
    <form action="infoMedecins.php" method="GET">
        <div class="container" >
            <label for="exampleDataList" class="form-label">Médecins</label>
            <select class="form-select" aria-label="Default select example" name="medecin" require>
            <?php 
                while($nomMedecin = $reqMedecins->fetch()){?>
                <option value="<?php echo $nomMedecin["id"];?>"> <?php echo $nomMedecin["nom"].' '.$nomMedecin['prenom'];?></option> 
            
            <?php }?>
            </select>
                <br>
                <button type="submit" class="btn btn-outline-primary">Information</button> 
                <br> <br>
            <?php
                if (isset($_GET['medecin'])) {
                
                    $reqMedecins = $db->query("SELECT * FROM medecin WHERE id = ".$infoMedecin."");
                    $r = $reqMedecins->fetch();
            
            ?>
                <table class="table table-striped">
                    <tr>
                        <th class="table-primary">Nom</th>
                        <th class="table-primary">Prénom</th>
                        <th class="table-primary">Spécialité complémentaire</th>
                        <th class="table-primary">Telephone</th>
                        <th class="table-primary">Departement</th>
                        <th class="table-primary">Adresse</th>
                        <th class="table-primary">Modifier les information</th>
                        <th class="table-primary">Tous les anciens rapports </th>
                    </tr>
                    <tr>
                        <td class="table-light"><?php echo $r['nom'];?></td>
                        <td class="table-light"><?php echo $r['prenom'];?></td>
                        <td class="table-light"><?php echo $r['specialitecomplementaire'];?></td>
                        <td class="table-light" ><?php echo $r['tel'];?></td>
                        <td class="table-light"><?php echo $r['departement'];?></td>
                        <td class="table-light"><?php echo $r['adresse'];?></td>
                        <td class="table-light" >
                            <a href="<?php echo 'infoMedecins1.php?id='.$r["id"].''?>">
                                <button type="button"  class="btn btn-outline-secondary">modifier</button> 
                            </a>
                        </td>
                        <td class="table-light"><button id="showRapport" type="button" method="GET" class="btn btn-outline-secondary">Anciens rapports</button></td>  
                    </tr>    
                </table>
                <br>
                <div class="hidden" id="rapport">
                    <?php 
                            $idVisiteur= $_SESSION['id'];
                            $reqRapport = $db->query("SELECT * FROM rapport WHERE idMedecin =".$infoMedecin." AND idVisiteur ='".$idVisiteur."'");
                            $nb=    $reqRapport->fetch();
                            if (isset($nb['datee']) ) {

                                while($nb = $reqRapport->fetch()){
                                    echo '  <table class="table table-striped">
                                                <tr>
                                                    <th class="table-primary">date</th>
                                                    <th class="table-primary">motif</th>
                                                    <th class="table-primary">bilan</th>
                                                </tr>
                                                <tr>
                                                    <td class="table-light">'.$nb["datee"].'</td>
                                                    <td class="table-light">'.$nb["motif"].'</td>
                                                    <td class="table-light">'.$nb["bilan"].'</td>
                                                </tr>    
                                            </table> ';
                                    }
                            }else {
                    ?>
                                    <!-- alert -->
                    
                        <div class="container">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Désolé</strong> Vous n'avez aucun rapport de visite avec ce médecin.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    <?php }?>
                </div>
            <?php } ?>
        </div>
    </form>   
</body>
<script>
    const btn=document.querySelector('#showRapport')
    const table=document.querySelector('#rapport')
    btn.addEventListener('click',function () {
     table.classList.remove('hidden')   
    })
</script>
</html>