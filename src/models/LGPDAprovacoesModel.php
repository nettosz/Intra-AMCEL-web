<?php

namespace src\Models;

use src\Models\Model;

class LGPDAprovacoesModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLGPDAprovacoes($id_lgpd)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $lgpds = $queryBuilder
            ->select('*')
            ->from('lgpd_aprovacoes')
            ->where('id_lgpd = :id')
            ->setParameter('id', $id_lgpd)
            ->execute()
            ->fetchAll();

        return $lgpds;
    }

    public function save($nm_arquivo, $id_lgpd)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->insert('lgpd_aprovacoes')
            ->setValue('nm_arquivo', ':nm_arquivo')
            ->setValue('id_lgpd', ':id_lgpd')
            ->setParameter('nm_arquivo', $nm_arquivo)
            ->setParameter('id_lgpd', $id_lgpd)
            ->execute();

        return $this->conn->lastInsertId();

        try {
            return $this->conn->lastInsertId();
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function update($id, $nm_arquivo)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->update('lgpd_aprovacoes')
            ->set('nm_arquivo', ':nm_arquivo');

        $queryBuilder
            ->where('id = :id')
            ->setParameter('nm_arquivo', $nm_arquivo)
            ->setParameter('id', $id)
            ->execute();

        return true;
        try {
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id_lgpd)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        try {
            $queryBuilder
                ->delete('lgpd_aprovacoes')
                ->where('id_lgpd = :id')
                ->setParameter('id', $id_lgpd)
                ->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
