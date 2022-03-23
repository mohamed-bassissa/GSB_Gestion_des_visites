<?php
session_start();

require('src/connectionpdo.php');

//requette pour afficher les médecines 





if (isset($_GET['id']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['adresse']) && isset($_POST['tel']) && isset($_POST['specialitecomplementaire']) && isset($_POST['departement'])){

    
    $nom= $_POST['nom'];
    $prenom= $_POST['prenom'];
    $adr = $_POST['adresse'];
    $tel    =$_POST['tel'];
    $specialite =$_POST['specialitecomplementaire']; 
    $departement    =$_POST['departement'];
    


    $req=$db->prepare("UPDATE medecin SET nom='$nom' ,prenom='$prenom' ,adresse='$adr' ,tel='$tel' ,specialitecomplementaire='$specialite',  departement='$departement' WHERE id='".$_GET['id']."';");
    $req->execute();
    
    
    header('location: ./infoMedecins.php');
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
    <?php
    
    $req1=$db->query("SELECT * FROM medecin WHERE id=".$_GET['id'].";");
    $r =$req1->fetch();
    ?> 
    <form action="#" method="POST">
        <div class="container">
            <table class="table table-striped">
                <tr>
                    <th class="table-primary">Nom</th>
                    <th class="table-primary">Prenom</th>
                    <th class="table-primary">Adresse</th>
                    <th class="table-primary">Telephone</th>
                    <th class="table-primary">Spécialité complémentaire</th>
                    <th class="table-primary">Département</th>
                </tr>
                <tr>
                    <td class="table-light"><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $r["nom"]?>" name='nom'></td>
                    <td class="table-light"><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $r["prenom"]?>" name='prenom'></td>
                    <td class="table-light"><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $r["adresse"]?>" name='adresse'></td>
                    <td class="table-light"><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $r["tel"]?>" name='tel'></td>
                    <td class="table-light"><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $r["specialitecomplementaire"]?>" name='specialitecomplementaire'></td>
                    <td class="table-light"><input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $r["departement"]?>" name='departement'></td> 
                </tr>
            </table>
            <button type="submit" class="btn btn-outline-primary">Enregistrer</button>    
        </div>
    </form>
    
</body>
</html>