<?php
function insertUsers($user)
{
   // require conection();
   // require "User.php";
    global $pdo;
    $insert = ("INSERT INTO `clanovi`(`ime`, `prezime`, `korisnicko_ime`, `sifra`)   VALUES (:ime, :pre, :koo, :sif)");
    $d = $pdo->prepare($insert);
    $d->execute(array(
        ':koo' => $user->getUsersname(),
        ':ime' => $user->getName(),
        ':pre' => $user->getLastname(),
        ':sif' => $user->getPassword()
    ));
}

function deleteUsers($id)
{
    require conection();
    global $pdo;
    $delete = ("DELETE FROM `clanovi` WHERE `id_clana`=:id");
    $del = $pdo->prepare($delete);
    $del->execute(array(
        ':id' => $id,
    ));

}

function selectUsers($name, $username)
{
  //  require conection();
    global $pdo;
    if ($name !== "" || $username !== "") {
        if ($name !== "") {
            $search = "SELECT id_clana, ime, prezime, korisnicko_ime,user_type,access FROM clanovi where CONCAT(ime, ' ', prezime) like :na";
            $pri = $pdo->prepare($search);
            $pri->execute(array(
                ':na' => $name . "%"
            ));
            if ($pri->rowCount() == 0) {
                $search = "SELECT `id_clana`, `ime`, `prezime`, `korisnicko_ime`,`user_type`,access  FROM clanovi where prezime like :na";
                $pri = $pdo->prepare($search);
                $pri->execute(array(
                    ':na' => $name . "%"
                ));
            }
        } else {
            $search = "SELECT `id_clana`, `ime`, `prezime`, `korisnicko_ime`,`user_type`,access FROM clanovi where korisnicko_ime like :username";
            $pri = $pdo->prepare($search);
            $pri->execute(array(
                ':username' => $username . "%"
            ));
        }
    } else {
        $search = "SELECT `id_clana`, `ime`, `prezime`, `korisnicko_ime`,`user_type`,access  FROM clanovi";
        $pri = $pdo->prepare($search);
        $pri->execute(array(
            ':na' => $name,
            ':username' => $username
        ));
    }

    if ($pri->rowCount() > 0) {

        $result = $pri->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }return $result=0;
}


function loginUsers($username, $password){
    global $pdo;
    $_SESSION['acount']=0;
    $qlogin = ("SELECT * FROM `clanovi` WHERE korisnicko_ime= :username AND sifra=:password");
    $log = $pdo->prepare($qlogin);
    $log->execute(array(
        ':username' => $username,
        ':password' =>md5($password)
    ));
    if ($log->rowCount() == 1) {
        require "User.php";
        $ac = $log->fetchAll(PDO::FETCH_OBJ);
        foreach ($ac as $aco) {
            echo "eeeeeeeee";
            $_SESSION['acount']= new User($aco->id_clana,$aco->ime,$aco->prezime,$aco->korisnicko_ime,$aco->sifra,$aco->user_type,$aco->access);
                $_SESSION['adm']=$aco->user_type;
        }

    }
    return $_SESSION['acount'];

}