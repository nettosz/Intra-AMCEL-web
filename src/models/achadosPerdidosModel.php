<?php

namespace src\Models;

use src\Models\Model;

class achadosPerdidosModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAchadosPerdidos()
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $achados_perdidos = $queryBuilder
            ->select('*')
            ->from('achados_perdidos')
            ->execute()
            ->fetchAll();

        return $achados_perdidos;
    }

    public function save($nome, $local, $data, $status, $nome_recebido, $data_recebido, $foto_name, $cod_usuario)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $queryBuilder
            ->insert('achados_perdidos')
            ->setValue('nome_achado', ':nome')
            ->setValue('local_achado', ':local')
            ->setValue('data_achado', ':data')
            ->setValue('foto', ':foto')
            ->setValue('status', ':status')
            ->setValue('nome_recebido', ':nome_rec')
            ->setValue('data_recebido', ':data_rec')
            ->setValue('cod_usuario', ':cod')
            ->setParameter('nome', $nome)
            ->setParameter('local', $local)
            ->setParameter('data', $data)
            ->setParameter('foto', $foto_name)
            ->setParameter('status', $status)
            ->setParameter('nome_rec', $nome_recebido)
            ->setParameter('data_rec', $data_recebido)
            ->setParameter('cod', $cod_usuario)
            ->execute();

        return $this->conn->lastInsertId();
        try {
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function update($nome, $local, $data, $status, $nome_recebido, $data_recebido, $foto_name, $id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        try {
            $queryBuilder
                ->update('achados_perdidos')
                ->set('nome_achado', ':nome')
                ->set('local_achado', ':local')
                ->set('data_achado', ':data')
                ->set('status', ':status')
                ->set('nome_recebido', ':nome_rec')
                ->set('data_recebido', ':data_rec');

            if (!!$foto_name) {
                $queryBuilder
                    ->set('foto', ':foto')
                    ->setParameter('foto', $foto_name);
            }

            $queryBuilder
                ->setParameter('nome', $nome)
                ->setParameter('local', $local)
                ->setParameter('data', $data)
                ->setParameter('status', $status)
                ->setParameter('nome_rec', $nome_recebido)
                ->setParameter('data_rec', $data_recebido);

            $queryBuilder
                ->where('id = :id')
                ->setParameter('id', $id)
                ->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        try {
            $queryBuilder
                ->delete('achados_perdidos')
                ->where('id = :id')
                ->setParameter('id', $id)
                ->execute();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getAchadoPerdido($id)
    {
        $queryBuilder = $this->conn->createQueryBuilder();

        $achado_perdido = $queryBuilder
            ->select('*')
            ->from('achados_perdidos')
            ->where('id =:id')
            ->setParameter('id', $id)
            ->execute()
            ->fetch();

        return $achado_perdido;
    }
}
