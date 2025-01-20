<?php

namespace src\Models;

use src\Models\Model;

class LGPDModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getLGPDs()
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $lgpds = $queryBuilder
            ->select('*')
            ->from('lgpd')
            ->execute()
            ->fetchAll();

        return $lgpds;
    }


    public function save($titulo, $data_criacao, $versao, $aprovadores,  $pt_pdf, $en_pdf)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->insert('lgpd')
            ->setValue('titulo', ':titulo')
            ->setValue('data_criacao', ':data_criacao')
            ->setValue('versao', ':versao')
            ->setValue('aprovadores', ':aprovadores')
            ->setValue('pdf', ':pdf')
            ->setValue('pdf_en', ':pdf_en')
            ->setParameter('titulo', $titulo)
            ->setParameter('data_criacao', $data_criacao)
            ->setParameter('versao', $versao)
            ->setParameter('aprovadores', $aprovadores)
            ->setParameter('pdf', $pt_pdf)
            ->setParameter('pdf_en', $en_pdf)
            ->execute();

        return $this->conn->lastInsertId();

        try {
            return $this->conn->lastInsertId();
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function update($titulo, $data_criacao, $versao, $aprovadores,  $pdf, $pdf_en, $id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->update('lgpd')
            ->set('titulo', ':titulo')
            ->set('data_criacao', ':data_criacao')
            ->set('versao', ':versao')
            ->set('aprovadores', ':aprovadores');

        if (!!$pdf) {
            $queryBuilder
                ->set('pdf', ':pdf')
                ->setParameter('pdf', $pdf);
        }

        if (!!$pdf_en) {
            $queryBuilder
                ->set('pdf_en', ':pdf_en')
                ->setParameter('pdf_en', $pdf_en);
        }

        $queryBuilder
            ->where('id = :id')
            ->setParameter('titulo', $titulo)
            ->setParameter('data_criacao', $data_criacao)
            ->setParameter('versao', $versao)
            ->setParameter('aprovadores', $aprovadores)
            ->setParameter('id', $id)
            ->execute();

        return true;
        try {
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        try {
            $queryBuilder
                ->delete('lgpd')
                ->where('id = :id')
                ->setParameter('id', $id)
                ->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getLGPD($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();
        $lgpd = $queryBuilder
            ->select('*')
            ->from('lgpd')
            ->where('id =:id')
            ->setParameter('id', $id)
            ->execute()
            ->fetch();

        return $lgpd;
    }
}
