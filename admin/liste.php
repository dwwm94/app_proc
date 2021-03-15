<?php
require_once('security.inc');
require_once('../connect.php');

if(isset($_POST['submit']) && !empty($_POST['search'])){
    $mCle = trim(addslashes(htmlentities($_POST['search'])));
    $sql = " SELECT * FROM personne p
    INNER JOIN langues l
    ON p.id_langue = l.id
    WHERE nom LIKE '$mCle%' OR libelle LIKE '$mCle%'";
}else{

$sql = "SELECT * FROM personne p
        INNER JOIN langues l
        ON p.id_langue = l.id";
}

$result = mysqli_query($conn, $sql);

?>

<?php require_once('../partials/header.inc'); ?>

<div class="container">

<h1> Liste des traducteurs </h1>
<p><a href="ajouter.php" class="btn btn-warning"><i class="fas fa-plus"> Ajouter </i></a></p>
<form action="<?=$_SERVER['PHP_SELF']; ?>" method="post">
    <div class="input-group justify-content-end">
        <input type="search" class="form-control offset-9 col-3 text-center" name="search" id="search" placeholder="Rechercher">
        <button type="submit" name="submit"><i class="fas fa-search"></i></button>
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>Nom</th>
            <th>Age</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Photo</th>
            <th>Langue</th>
            <th>Date de creation</th>
            <th colspan="2" class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php while($rows = mysqli_fetch_assoc($result)){  ?>
        <tr>
            <td><?= $rows['id_p']; ?></td>
            <td><?= $rows['nom']; ?></td>
            <td><?= $rows['age']; ?></td>
            <td><?= $rows['telephone']; ?></td>
            <td><?= $rows['email']; ?></td>
            <td><img src="../assets/images/<?=$rows['image']; ?>"width="60"/></td>
            <td><?= $rows['libelle']; ?></td>
            <td><?= $rows['created']; ?></td>
            <td><a href="editer.php?id=<?=$rows['id_p'];?>" class="btn btn-success"><i class="fas fa-edit"></a></td>
            <td><a href="supprimer.php?id=<?=$rows['id_p'];?>" class="btn btn-danger" onclick="return confirm('Etes vous sûr de vouloir supprimer?')"><i class="fas fa-trash"></i></a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
<?php require_once('../partials/footer.inc'); ?>