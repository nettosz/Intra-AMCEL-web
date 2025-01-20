<?php

namespace src\Models;

use src\Models\Model;

class homeDesignModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add(string $imagem_fundo)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->insert('home_design')
            ->setValue('imagem_fundo', ':imagem_fundo')
            ->setParameter(':imagem_fundo', $imagem_fundo);

        try {

            $queryBuilder->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function edit(int $id, string $imagem_fundo)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $queryBuilder
            ->update('home_design')
            ->set('imagem_fundo', ':imagem_fundo')
            ->where('id = :id')
            ->setParameter(':imagem_fundo', $imagem_fundo)
            ->setParameter(':id', $id);

        try {
            $queryBuilder->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete(int $id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->delete('home_design')
            ->where('id = :id')
            ->setParameter(':id', $id);
        try {
            $queryBuilder->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }


    public function getHomeDesign()
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->select('*')
            ->from('home_design');
        try {
            $home_design = $queryBuilder->execute()->fetch();

            return $home_design;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
