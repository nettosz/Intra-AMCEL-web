<?php

namespace src\Models;

use src\Models\Model;
use src\Models\perfilModel;
use src\models\perfilAcessoModel;

class usuarioModel extends Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function add($email, $cod_perfil)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    if (!$this->isExistUser($email)) {
      $queryBuilder
        ->insert('usuario')
        ->setValue('email', ':email')
        ->setValue('cod_perfil_acesso', ':cod_perfil')
        ->setParameter('email', $email)
        ->setParameter('cod_perfil', $cod_perfil)
        ->execute();

      return 1;
    } else {
      $perfil = new perfilModel();
      $perfilAcesso = new perfilAcessoModel();
      $this->deleteByCodPerfil($cod_perfil);
      $perfilAcesso->delete($cod_perfil);
      $perfil->delete($cod_perfil);

      return 'Existem emails repetidos';
    }
    // try {
    // } catch (\Throwable $th) {
    //   return 0;
    // }
  }

  public function isExistUser($email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $usuario =  $queryBuilder
        ->select('*')
        ->from('usuario')
        ->where('email = :email')
        ->setParameter('email', $email)
        ->execute()
        ->fetch();
      if ($usuario) return true;
      else false;
    } catch (\Throwable $th) {
      return false;
    }
  }
  public function isUserSemPerfil($email, $codPerfil = 48)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $usuario =  $queryBuilder
        ->select('*')
        ->from('usuario')
        ->where('email = :email and cod_perfil_acesso = :codPerfil')
        ->setParameter('email', $email)
        ->setParameter('codPerfil', $codPerfil)
        ->execute()
        ->fetch();

      if ($usuario) return $usuario;
      else false;
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function isExistPerfilUser($cod_perfil, $email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $usuario =  $queryBuilder
        ->select('*')
        ->from('usuario')
        ->where('email = :email and cod_perfil_acesso = :codPerfil')
        ->setParameter('email', $email)
        ->setParameter('codPerfil', $cod_perfil)
        ->execute()
        ->fetch();

      if ($usuario) return $usuario;
      else false;
    } catch (\Throwable $th) {
      return false;
    }
  }
  public function updatePerfil($email, $codePerfil = 48)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $queryBuilder
      ->update('usuario')
      ->set('cod_perfil_acesso', ':codPerfil')
      ->where('email = :email')
      ->setParameter('codPerfil', $codePerfil)
      ->setParameter('email', $email)
      ->execute();
  }

  public function getArrDuplicado($array)
  {
    return array_unique(array_diff_assoc($array, array_unique($array)));
  }

  public function updateByPerfil($emails, $cod_perfil)
  {
    $emailsExistInPerfil = explode(' | ', $this->getEmailsInPerfil($cod_perfil));
    $emails = explode(' | ', $emails);

    $emailsRetirados = '';
    $menssagem = 'alguns emails não foram inseridos pois já pertencem a outro perfil, email: ';
    $isExistEmailInOtherPerfil = false;

    if (!$this->getArrDuplicado($emails)) {
      foreach ($emailsExistInPerfil as $emailExistInPerfil) {
        if (!in_array($emailExistInPerfil, $emails)) {
          $usuario = $this->isExistPerfilUser($cod_perfil, $emailExistInPerfil);
          if ($usuario['status_cadastro'] === 'C') {
            $this->updatePerfil($emailExistInPerfil);
          } else {
            $this->deleteByEmail($emailExistInPerfil);
          }
        }
      }


      foreach ($emails as $email) {
        if (!$this->isExistUser($email)) {

          $this->add($email, $cod_perfil);
        } else {
          $usuario =  $this->isExistPerfilUser($cod_perfil, $email);
          if (!$usuario) {
            $userSemPerfil = $this->isUserSemPerfil($email);
            if ($userSemPerfil) {
              $this->updatePerfil($email, $cod_perfil);
            } else {
              $menssagem .= $email . ', ';
              $isExistEmailInOtherPerfil = true;
            }
          }
        }
      }
    } else {
      !$isExistEmailInOtherPerfil = true;
      $menssagem = 'Existem emails duplicados!';
    }



    if (!$isExistEmailInOtherPerfil) return 1;
    else return $menssagem;
  }

  public function getEmailsInPerfil($cod_perfil)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $emails =  $queryBuilder
      ->select('email')
      ->from('usuario')
      ->where('cod_perfil_acesso = :cod_perfil')
      ->setParameter('cod_perfil', $cod_perfil)
      ->execute()
      ->fetchAll();

    $emailsString = '';


    try {
      if (!empty($emails)) {
        foreach ($emails as $email) {
          $emailsString .= ' | ' . $email['email'];
        }
        return substr($emailsString, 3);
      }
      return '';
    } catch (\Throwable $th) {
      return false;
    }
  }

  public function isExistUserEmail($email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('usuario')
      ->where('email = :email')
      ->setParameter('email', $email);

    try {
      $usuario = $queryBuilder->execute()->fetch();

      if ($usuario) return true;
      else return false;
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function deleteByEmail($email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $queryBuilder
        ->delete('usuario')
        ->where('email = :email')
        ->setParameter('email', $email)->execute();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function deleteByCodPerfil($cod_perfil)
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    try {
      $queryBuilder
        ->delete('usuario')
        ->where('cod_perfil_acesso = :cod_perfil')
        ->setParameter('cod_perfil', $cod_perfil)->execute();
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function isCadComplete($email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->select('*')
      ->from('usuario')
      ->where('email = :email and status_cadastro = :status')
      ->setParameter('email', $email)
      ->setParameter('status', 'C');

    try {
      $usuario = $queryBuilder->execute()->fetch();
      if ($usuario['status_cadastro'] === 'C') return true;
      else return false;
    } catch (\Throwable $th) {
      return 0;
    }
  }
  public function getID()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $user = unserialize($_SESSION['user']);

    $usuario = $queryBuilder
      ->select('id')
      ->from('usuario')
      ->where('email =:email')
      ->setParameter('email', $user->getEmail())
      ->execute()->fetch();
    return $usuario['id'];
  }


  public function getUserPerfil()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $user = unserialize($_SESSION['user']);

    $usuario = $queryBuilder
      ->select('cod_perfil_acesso')
      ->from('usuario')
      ->where('email =:email')
      ->setParameter('email', $user->getEmail())
      ->execute()->fetch();
    return $usuario['cod_perfil_acesso'];
  }
  public function updateUsuarioByCadastro($nome, $data_nascimento, $cod_cargo, $ramal, $email)
  {
    $queryBuilder = $this->conn->createQueryBuilder();

    $queryBuilder
      ->update('usuario')
      ->set('ramal', ':ramal')
      ->set('nome', ':nome')
      ->set('dt_nascimento', ":data")
      ->set('cod_cargo', ':codCargo')
      ->set('status_cadastro', ':status')
      ->where('email = :email')
      ->setParameter('ramal', (empty($ramal)) ? 0 : $ramal)
      ->setParameter('nome', $nome)
      ->setParameter('data', $data_nascimento)
      ->setParameter('codCargo', $cod_cargo)
      ->setParameter('status', 'C')
      ->setParameter('email', $email);

    $queryBuilder->execute();
    try {
      return 'Cadastro Finalizado!';
    } catch (\Throwable $th) {
      return 0;
    }
  }

  public function getPerfil()
  {
    $queryBuilder = $this->conn->createQueryBuilder();
    $userID = $this->getID();

    try {
      
      $user = $queryBuilder
        ->select('u.nome, u.email, u.ramal, u.dt_nascimento, c.nome nome_cargo, d.nome nome_departamento')
        ->from('usuario', 'u')
        ->innerJoin('u', 'cargos', 'c', 'c.id = u.cod_cargo')
        ->innerJoin('c', 'departamentos', 'd', 'd.id = c.cod_departamento')
        ->where('u.id = :id')
        ->setParameter('id', $userID)
        ->execute()
        ->fetch();

      return $user;
    } catch (\Throwable $th) {
      return 0;
    }
  }
}
