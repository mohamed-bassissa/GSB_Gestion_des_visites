<?php 
session_start();

//connection a la basse de donnés

require('src/connectionpdo.php');

if (isset($_POST['datee'])) {
    
    $datee        = $_POST['datee'];
    $idVisiteur  = $_SESSION['id'];
    
    $req = $db->query(" SELECT * FROM rapport WHERE datee = '{$datee}' and idVisiteur = '{$idVisiteur}' "); 
      
}            

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modifier un rapport</title>
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
        <!-- end navbar -->
    <div class="text-center">
        <h1 class="display-4">modifier un rapport</h1>        
    </div>
    <form action="modifierRapport.php" method="POST">
        <div class="container">     
            <div class="mb-3">
                <label for="exampleInputdate" class="form-label">Date</label>
                <input type="date" value="<?php echo date("Y-m-j"); ?>" class="form-control" id="exampleInputdate" name="datee" required>
            </div> 
            <button type="submit" class="btn btn-primary">Les rapports</button>
        </div>
        <br>
    <div class="container"> 
    <?php if (isset($_POST['datee'])) {
     
        while ($r = $req->fetch()) {?>
    <table class="table table-striped">
    <tr>
        <th class="table-primary">modifier</th>
        <th class="table-primary">motif</th>
        <th class="table-primary">bilan</th>
    </tr>
    <tr>
        <td class="table-light"><a href="<?php echo 'modifierRapport1.php?id='.$r["id"].''?>"><button type="button" class="btn btn-outline-primary">modifier</button></a></td>
        <td class="table-light"><?php echo $r['motif'];?></td>
        <td class="table-light"><?php echo $r['bilan'];?></td> 
    </tr>    
    </table>
    <?php } } ?> 
    </div>
    </form>
</body>
</html>