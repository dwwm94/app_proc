<?php
require_once('security.inc');
require_once('../connect.php');
$error = "";
$sql = "SELECT id, libelle FROM langues";
$res = mysqli_query($conn, $sql);

if(isset($_POST['soumis'])){
    if(isset($_POST['nom']) && strlen($_POST['nom'])<=20 && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        $nom = trim(htmlspecialchars(addslashes($_POST['nom'])));
        $prenom = trim(htmlspecialchars(addslashes($_POST['prenom'])));
        $age = trim(htmlspecialchars(addslashes($_POST['age'])));
        $email = trim(htmlspecialchars(addslashes($_POST['email'])));
        $telephone = trim(htmlspecialchars(addslashes($_POST['phone'])));
        $id_l = trim(htmlspecialchars(addslashes($_POST['langue'])));
        $description= trim(htmlspecialchars(addslashes($_POST['desc'])));
        $image = $_FILES['image']['name'];

        $destination ="../assets/images/";
        move_uploaded_file($_FILES['image']['tmp_name'], $destination.$image);

        $sql2= "INSERT INTO personne(nom, prenom, age, email, telephone, id_l,image, description)
                VALUES('$nom','$prenom','$age', '$email','$telephone','$id_l','$image','$description')";
        $result = mysqli_query($conn, $sql2);
        if(mysqli_insert_id($conn) > 0){
            header('location:liste.php');
        }else{
            $error = '<div class="alert alert-danger">Erreur d\'insertion</div>';
        }
        
    }
}

require_once('../partials/header.inc'); 
?>
<div class="offset-2 col-8">
<h1 class="bg-dark text-center text-white">Administration</h1>
<h2>Formulaire d'ajout</h2>
    <?= $error; ?>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <div class="row">
    <div class="col-5">
        <label for="nom">Nom*</label>
        <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom svp" required>
    </div>
    <div class="col-5">
        <label for="prenom">Prénom*</label>
        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom svp" required>
    </div>
    <div class="col-2">
        <label for="age">Age*</label>
        <input type="number" class="form-control" id="age" name="age" placeholder="Entrez votre âge svp" min="18" required>
    </div>
    </div>
    <div class="row">
    <div class="col">
        <label for="email">Email adresse*</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email svp" required>
    </div>
    <div class="col">
        <label for="phone">Téléphone*</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Entrez votre numéro de téléphone svp" required>
    </div>
    </div>
    <div class="row">
    <div class="col">
        <label for="image">Photo</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="col">
        <label for="langue">Langue*</label>
        <select class="form-select" id="langue" name="langue" >
        <option >Choisir</option>
        <?php while($rows = mysqli_fetch_assoc($res)){ ?>
            <option value="<?=$rows['id']; ?>"><?=$rows['libelle']; ?></option>
        <?php } ?>
        </select>
    </div>
    </div>
    <div class="row">
    <div class="col mb-2">
        <label for="desc">Description</label>
        <textarea  class="form-control" id="desc" name="desc" rows="5" placeholder="Entrez la description svp"></textarea>
    </div>

    </div>
    <button type="submit" class="btn btn-success col-12" name="soumis" >Soumettre</button>
    </form>
</div>
<?php require_once('../partials/footer.inc');?>