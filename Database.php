<?php
class Database
{
    /** @var Mysqli $connection */
    private $connection;

    /**
     * Database constructor.
     * @param $connection
     */
    public function __construct($connection)
    {
        $this->connection = $connection;
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

        return $upit;
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


}