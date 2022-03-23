<?php
session_start();
//connection a la basse de donnés

require('src/connectionpdo.php');

//afficher les médecines 
$reqMedecins = $db->query('SELECT * FROM medecin');

$reqMedicament = $db->query('SELECT * FROM medicament');





//pour inserée les donnée de rapport

if(isset($_POST['datee']) && isset($_POST['motif']) && isset($_POST['bilan'])){
    
    $datee           = $_POST['datee'];
    $motif          = $_POST['motif'];
    $bilan          = $_POST['bilan'];
    $idVisiteur     = $_SESSION['id'];
    $idMedecin      = $_POST['medecin'];
    $medicament     = $_POST['medicament'];
    
    
    $req = $db->prepare(" INSERT INTO rapport(datee, motif, bilan, idVisiteur, idMedecin)
                                VALUES (?, ?, ?, ?, ?) 
                        ");
     $req->execute(array($datee, $motif, $bilan, $idVisiteur, $idMedecin));
    
     
    $reqRapport    =$db->query("SELECT MAX(id) as id FROM rapport ");
     
    if (isset($_POST['quantite'])) {

        $quantite       = $_POST['quantite'];
        $idMedicament   = $_POST['medicament'];
        $idRapport      = $reqRapport->fetch();
        

    
        $req = $db->prepare(" INSERT INTO offrir(quantite, idMedicament ,idRapport)
                              VALUES (?, ?, ?) 
                            ");
        $req->execute(array($quantite, $idMedicament, $idRapport['id']));
    
    }
    
    header('location:accueill.php');


}


    
                    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crée un rapport</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/headers/">
    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
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
                <li class="nav-item dropdown"><a class="nav-link active " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-current="page">Gérer mes rapports de visite</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="creeRapport.php">créer un nouveau rapport </a></li>
                    <li><a class="dropdown-item" href="modifierRapport.php">modifier un rapport</a></li>                               
                </ul>
                </li>
                <li class="nav-item dropdown"><a class="nav-link " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false" aria-current="page">Gérer mes médecins</a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="infoMedecins.php">informations des médecins</a></li>                              
                </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="seDeconecter.php">Se Déconecter</a></li>
            </ul> 
        </header>
    </main>
    <div class="container">
            <!-- end navbar -->
    <div class="text-center">
            <h1 class="display-4">Crée un rapport</h1>        
    </div>
    <div class="container">
        <form method="POST" action="creeRapport.php">
            <label for="exampleDataList" class="form-label">Médecins</label>
            <select class="form-select" aria-label="Default select example" name="medecin" required>
            <?php 
                while($nomMedecin = $reqMedecins->fetch()){?>
                <option value="<?php echo $nomMedecin["id"];?>"> <?php echo $nomMedecin["nom"].' '.$nomMedecin['prenom'];?></option> 
                <?php }?>
            </select>       
            <div class="mb-3">
                <label for="exampleInputdate" class="form-label">Date</label>
                <input type="date" value="<?php echo date("Y-m-j"); ?>" class="form-control" id="exampleInputdate" name="datee" required >
            </div>
            <div class="mb-3"> 
                <label for="exampleInputtext" class="form-label">Motif</label>
                <input type="text" class="form-control" id="exampleInputtext" name="motif" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputtext" class="form-label">Bilan</label>
                <input type="text" class="form-control" id="exampleInputtext" name="bilan" required>
            </div>
            <!-- MEDICAMENT -->
            <label for="exampleDataList" class="form-label">Médicament 1</label>
            <select class="form-select" aria-label="Default select example" name="medicament" required>
            <?php 
                while($nomMedicament = $reqMedicament->fetch()){?>
                <option value="<?php echo $nomMedicament["id"]?>"> <?php echo $nomMedicament["nomCommercial"];?></option> 
                <?php }?>   
            </select>
            <div class="mb-3">
                <label for="exampleInputnumber" class="form-label">Quantite</label>
                <input type="number" class="form-control" id="exampleInputnumber" name="quantite" required>
            </div>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>
    </div>
</body>
</html>