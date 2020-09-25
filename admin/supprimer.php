<?php
$noNavbar = '';
include 'init.php';
if (isset($_GET['id_client'])) {
    if (!empty($_GET['id_client'])) {
        $id_client    = $_GET['id_client'];
        $req_supp_cli = 'Delete p.*, c.* From personne as p join client as c where c.REFPERSONNE =p.ID AND c.REFPERSONNE=' . $id_client;
        $conn->query($req_supp_cli);
        header('location:affichage_client.php?p=1');
    }
}
if (isset($_GET['id_employe'])) {
    if (!empty($_GET['id_employe'])) {
        $id_employe   = $_GET['id_employe'];
        $req_supp_emp = 'Delete p.*, e.* From personne as p join employe as e where e.REFPERSONNEE =p.ID AND e.REFPERSONNEE=' . $id_employe;
        $conn->query($req_supp_emp);
        header('location:affichage_employe.php?p=1');
    }
}
if (isset($_GET['id_tache_negoc'])) {
    if (!empty($_GET['id_tache_negoc'])) {
        $id_tache       = $_GET['id_tache_negoc'];
        $req_supp_negoc = 'update tache set etat_negoc=0, etat_aff=0, REFEMPLOYE=0 where ID=' . $id_tache . ';';
        $conn->query($req_supp_negoc);
        header('location:liste_negoc.php?p=1');
    }
}
if (isset($_GET['id_projet'])) {
    if (!empty($_GET['id_projet'])) {
        $id_projet     = $_GET['id_projet'];
        $req_supp_proj = 'Delete From `projet` where id_projet=' . $id_projet . ';';
        $conn->query($req_supp_proj);
        $req_supp_tacheprojet = 'Delete From `tache` where REFPROJET=' . $id_projet . ';';
        $conn->query($req_supp_tacheprojet);
        header('location:affichage_projet.php?p=1');
    }
}
if (isset($_GET['id_tache'])) {
    if (!empty($_GET['id_tache'])) {
        $id_tache = $_GET['id_tache'];
        $req      = 'Select p.* from `projet` as p join `tache` as t where t.`REFPROJET`=p.`id_projet` AND t.ID=' . $id_tache;
        $res      = $conn->query($req);
        $data     = array();
        while ($r = $res->fetch_assoc()) {
            $data[] = $r;
        }
        foreach ($data as $d) {
            $n = $d['id_projet'];
        }

        $req_supp_tache = 'Delete From `tache` where ID=' . $id_tache . ';';
        $conn->query($req_supp_tache);
        header('location:affichage_taches.php?id_projet=' . $n . '&p=1');
    }
}
if (isset($_GET['id_client'])) {
    if (!empty($_GET['id_client'])) {
        $id_client    = $_GET['id_client'];
        $req_supp_cli = 'Delete p.*,c.* From personne as p join client as c where c.REFPERSONNE =p.ID AND c.REFPERSONNE=' . $id_client;
        $conn->query($req_supp_cli);
        header('location:affichage_client.php?p=1');
    }
}
