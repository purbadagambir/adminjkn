<?php

class M_emed
{
    private $dbh;

    function __construct()
    {
    }

    public function priceGroups()
    {
        $sql = $this->dbh->prepare('SELECT * FROM PRICE_GROUPS');
        $sql->execute();
        $hasil = $sql->fetchAll();

        var_dump($hasil);
    }
}
