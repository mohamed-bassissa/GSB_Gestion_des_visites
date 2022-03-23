<?php
session_start();

if (isset($_session['connect'])) {
    header('location: ./accueill.php');
}

require('src/connectionpdo.php');

//FORMULER CONNECTION

if (!empty($_POST['login']) && !empty($_POST['mdp'])) {
   
    //VARIABLES

    $login   = $_POST['login'];
    $mdp     = $_POST['mdp'];
    $error   = 1;

    //REQUETE POUR SE CONNECTER
    $req = $db->prepare('SELECT * FROM 	visiteur WHERE login =?');
	$req->execute(array($login));

    while ($gsbrapports = $req->fetch()) {

	
	if ($mdp == $gsbrapports['mdp']) {
			$error = 0;

            $_SESSION['connect'] = 1;
            $_SESSION['id']= $gsbrapports['id'];
            header('location: ./accueill.php?success=1');
		
	}
  
	}
    if ($error == 1) {
        header('location: ./index.php?error=1');
    }
    	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Se connecté</title>
</head>
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    .cadr{
        display:flex;
        padding:20px;
        justify-content:center;   
    }
    .img-thumbnail{
        max-width: 30%;
        border: none;
        margin: 30px;
    }
</style>
<body>
<?php
if (isset($_GET['error'])) {?>
			<div class="alert alert-danger" role="alert">nous ne peuvons pas vous authentifier.</div>            
<?php }?> 
    <main>
        <!-- <div class="container"> -->
            <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="accueill.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                <span class="fs-4 bleu"><img src="img/logo_gsb.webp" class="img-thumbnail" alt=""></span>
            </a>
            </header>
        <!-- </div> -->
    </main> 
<div class="cadr">
    <form method="POST" action="index.php">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Login</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="EX : Mohamd" name="login" require>
        <div id="emailHelp" class="form-text"></div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control"value="EX : ********" id="exampleInputPassword1" name="mdp" require>
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary position-relative">Connexion</button>
    </form>
</div>
</body>
</html>
