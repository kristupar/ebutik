<?php
class Database
{
    /** @var Mysqli $connection */
    private $connection;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        $this->connection = new Mysqli('localhost','root','','ebutik');
        $this->connection->set_charset("utf8");

        if($this->connection->connect_errno) {
            die('Neuspela konekcija na bazu!');
        }
    }

    public function select($imeTabele)
    {
        $upit = "SELECT * FROM " . $imeTabele;
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function insert($tabela, $variable = []) {
        if(empty($tabela) || empty($variable)) {
            return false;
        }

        $sql = "INSERT INTO $tabela ";

        $polja = [];
        $vrednosti = [];
        foreach($variable as $field => $value) {
            $polja[] = $field ;
            $vrednosti[] = "'" . $value . "'";
        }

        $polja = '(' . implode(', ', $polja) . ')';
        $vrednosti = '(' . implode(', ', $vrednosti) . ')';

        $sql .= $polja . ' VALUES ' . $vrednosti;

        $success = $this->connection->query($sql);

        return $success;
    }

    public function vratiOdecu()
    {
        $upit = "SELECT * FROM odeca o join kolekcija k on o.kolekcijaID = k.kolekcijaID" ;
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function vratiOdecuPoIdu($id)
    {
        $upit = "SELECT * FROM odeca o join kolekcija k on o.kolekcijaID = k.kolekcijaID WHERE odecaID = ".$id ;
        $rez = $this->connection->query($upit);

        while ($r = $rez->fetch_object()){
            return $r;
        }

        return null;
    }

    public function vratiOdecuZaIdijeve($idjeviOdeceUKorpi)
    {
        $upit = "SELECT * FROM odeca o join kolekcija k on o.kolekcijaID = k.kolekcijaID WHERE odecaID IN (".$idjeviOdeceUKorpi.")";
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function login($ime, $lozinka)
    {
        $ime = $this->connection->real_escape_string($ime);
        $lozinka = $this->connection->real_escape_string($lozinka);

        $upit = "SELECT * FROM korisnik WHERE korisnickoIme = '".$ime ."' AND korisnickaSifra = '". $lozinka ."' LIMIT 1";
        $rez = $this->connection->query($upit);

        while ($r = $rez->fetch_object()){
            return $r;
        }

        return null;
    }

    public function vratiOdecuSortirano(array $sortiranje, $min, $max)
    {
        $smer = $sortiranje[0];
        $kolona = $sortiranje[1];

        $sortSmer = $smer == 'rastuce' ? 'asc' : 'desc';

        $upit = "SELECT * FROM odeca o join kolekcija k on o.kolekcijaID = k.kolekcijaID WHERE cena < ". $max ." AND cena > ".$min ." ORDER BY ".$kolona." ".$sortSmer ;
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function vratiID()
    {
        return $this->connection->insert_id;
    }

    public function vratiNarudzbineZaKorisnika($id)
    {
        $upit = "SELECT * FROM narudzbina WHERE korisnikID = ". $id;
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function vratiKorisnike()
    {
        $upit = "SELECT imeIPrezimeKorisnika,korisnikid,ulogaUSistemu FROM korisnik";
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function vratiNarudzbineSaStatusomObrada()
    {
        $upit = "SELECT * FROM narudzbina WHERE status ='U procesu obrade' ";
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function vratiStavkeZaNarudzbinu($id)
    {
        $upit = "SELECT * FROM odeca o join kolekcija k on o.kolekcijaID = k.kolekcijaID join stavkanarudzbine sn on sn.odecaID=o.odecaID WHERE sn.narudzbinaID =   ". $id;
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

    public function promeniStatus($id, $status)
    {
        $upit = "UPDATE narudzbina set status = '".$status."' WHERE narudzbinaID=".$id;
        return $this->connection->query($upit);
    }

    public function podaciZaGrafik()
    {
        $upit = "SELECT o.nazivModela,sum(n.kolicina) as brojKupovina FROM stavkanarudzbine n join odeca o on n.odecaID = o.odecaID GROUP BY n.odecaID  ";
        $rez = $this->connection->query($upit);
        $niz = [];
        while ($r = $rez->fetch_object()){
            $niz[] = $r;
        }

        return $niz;
    }

}