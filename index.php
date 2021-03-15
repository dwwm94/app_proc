<?php
require_once('connect.php');
$sql = "SELECT * FROM personne p
        INNER JOIN langues l
        ON p.id_langue = l.id";

$result = mysqli_query($conn, $sql);


function trDate($date){
    $dateArray = (explode("-",substr(($date),0,10)));
    $dateIns = $dateArray[2]."/".$dateArray[1]."/".$dateArray[0];
    return $dateIns;
}
?>
<?php require_once('partials/header.inc');?>
<div class="container">
    <div class="bg-light text-center p-5">
        <h1>Traducteurs assermentés</h1>
        <p>Vos traducteurs sont à votre service ...</p>
    </div> 

    <div>
        <div class="row row-cols-1 row-cols-md-3 g-4 mt-2">
        <?php while($rows = mysqli_fetch_assoc($result)){ ?>
            <div class="col">
              <div class="card">
                <img src="assets/images/<?=$rows['image'];?>" class="card-img-top" alt="..." height="300">
                <div class="card-body">
                  <h5 class="card-title text-center">Traducteur N°: TS00<?=$rows['id_p'];?></h5>
                  <p class="text-right">
                      <img src="assets/images/<?=$rows['drapeau'];?>" alt="">
                  </p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nom et prénom: <?=$rows['nom'];?>-<?=$rows['prenom'];?></li>
                    <li class="list-group-item">Langue: <?=$rows['libelle'];?></li>
                    <li class="list-group-item">Age: <?=$rows['age'];?></li>
                    <li class="list-group-item">Email: <?=$rows['email'];?></li>
                    <li class="list-group-item">Téléphone: <?=$rows['telephone'];?></li>
                    <li class="list-group-item">Inscrit le: <?=trDate($rows['created']);?></li>
                 </ul>
                 <hr>
                  <p class="card-text"><?=$rows['description'];?></p>
                </div>
              </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php require_once('partials/footer.inc');?>