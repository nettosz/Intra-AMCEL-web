<?php

namespace src\Models;

use src\Models\Model;

class visitasModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getContador()
    {
        $select = $this->conn->createQueryBuilder();

        $select
            ->select('contador')
            ->from('quantidade_visitas')
            ->where('id = 1');

        $contador = $select->execute()->fetchColumn(0);

        return $contador;
    }

    public function incrementCount()
    {
        $update = $this->conn->createQueryBuilder();


        $update
            ->update('quantidade_visitas')
            ->set('contador', ':contador')
            ->where('id = 1')
            ->setParameter('contador', $this->getContador() + 1);

        $update->execute();

        return $this->getContador();
    }
}
