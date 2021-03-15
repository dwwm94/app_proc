<?php

require_once('../connect.php');

if(isset($_GET['id']) && $_GET['id'] < 1000){
    $id = (int)htmlspecialchars(addslashes($_GET['id'])); // on recup l'id qui passe en parametre

    $req = "SELECT image FROM personne WHERE id_p =".$id; // on va chercher le num de l'image avec l'id
    $res = mysqli_query($conn, $req);
    $data = mysqli_fetch_assoc($res); // on recupere l'image avec le fetch

    $sql = "DELETE FROM personne WHERE id_p = ".$id;

    $result = mysqli_query($conn, $sql);

    if(mysqli_affected_rows($conn) > 0){
        copy('../assets/images/'.$data['image'], '../assets/archives/'.$data['image']); // on copie le fichier supprimé dans archives
        unlink('../assets/images'.$data['image']); 
        header('location:liste.php'); // on redirige vers la liste
    }else{
        echo '<div class=""> Erreur de suppression </div>';
    }

}

// ?>




 <?php

// require_once('../connect.php');

// if(isset($_GET['id']) && $_GET['id'] < 1000){
//     $id = (int)htmlspecialchars(addslashes($_GET['id']));

//     $req = "SELECT image FROM personne WHERE id_p =".$id;
//     $res = mysqli_query($conn, $req);
//     $data = mysqli_fetch_assoc($res);

//     $sql = "DELETE FROM personne WHERE id_p =".$id;
//     $result = mysqli_query($conn, $sql);

//     if(mysqli_affected_rows($conn) > 0){
//         copy('../assets/images/'.$data['image'], '../assets/archives/'.$data['image']);
//         unlink('../assets/images/'.$data['image']);
//         header('location:liste.php');
//     }else{
//         echo'<div class="">Erreur de suppression</div>';
//     }
// }

// ?>