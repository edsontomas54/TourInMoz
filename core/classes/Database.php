<?php

namespace core\classes;

use PDO;
use PDOException;
use Exception;

class Database
{

    private $ligacao;
    //================================================================================
    private function ligar()
    {
        
        //ligar a base de dados....
        $this->ligacao = new PDO(
            'mysql:' .
                'host=' . MYSQL_SERVER . ';' .
                'dbname=' . MYSQL_DATABASE . ';' .
                'charset=' . MYSQL_CHARST,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        //debug
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    //================================================================================

    private function desligar()
    {
        //desliga-se da base de dados
        $this->ligacao = null;
    }
    //================================================================================
    //CRUD
    //================================================================================


    public function select($sql, $parametros = null)
    {
        //Limpar os espaços no $sql para nao dar o erro!
        $sql = trim($sql);

        //VERIFICA SE É UMA INSTRUÇÃO SELECT
        if (!preg_match("/^SELECT/i", $sql)) { //o preg_match verifica que de facto é selelect ou não...

            throw new Exception("Base de dados - não é uma instrução SELECT");
        }
        //executa função de pesquisa de SQL
        $this->ligar();
        $resultados = null;
        //comunicar
        try {
            // comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);

                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }
        //desligar a bd
        $this->desligar();
        //devolcer os resultados
        return $resultados;
    }

    //INSERT METHOD
    public function insert($sql, $parametros = null)
    {
        //Limpar os espaços no $sql para nao dar o erro!
        $sql=trim($sql);

        //VERIFICA SE É UMA INSTRUÇÃO SELECT
        if (!preg_match("/^INSERT/i", $sql)) { //o preg_match verifica que de facto é selelect ou não...

            throw new Exception("Base de dados - não é uma instrução INSERT");
        }
        //LIGAR
        $this->ligar();

        //comunicar
        try {
            // comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }
        //desligar a bd
        $this->desligar();
    }


    //UPDATE
    public function update($sql, $parametros = null)
    {
        //Limpar os espaços no $sql para nao dar o erro!
        $sql=trim($sql);

        //VERIFICA SE É UMA INSTRUÇÃO SELECT
        if (!preg_match("/^UPDATE/i", $sql)) { //o preg_match verifica que de facto é selelect ou não...

            throw new Exception("Base de dados - não é uma instrução UPDATE");
        }
        //LIGAR
        $this->ligar();

        //comunicar
        try {
            // comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }
        //desligar a bd
        $this->desligar();
    }

    //DELETE
    public function delete($sql, $parametros = null)
    {
        //Limpar os espaços no $sql para nao dar o erro!
        $sql=trim($sql);

        //VERIFICA SE É UMA INSTRUÇÃO SELECT
        if (!preg_match("/^DELETE/i", $sql)) { //o preg_match verifica que de facto é selelect ou não...

            throw new Exception("Base de dados - não é uma instrução DELETE");
        }
        //LIGAR
        $this->ligar();

        //comunicar
        try {
            // comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }
        //desligar a bd
        $this->desligar();
    }

    //=================================================================
    //GENÉRICO diferentes dos metodos acima!
    //=================================================================
    public function statement($sql, $parametros = null)
    {
        //Limpar os espaços no $sql para nao dar o erro!
        $sql=trim($sql);
        

        //VERIFICA SE É UMA INSTRUÇÃO SELECT
        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) { //o preg_match verifica que de facto é selelect ou não...

            throw new Exception("Base de dados - instrucão inválida! ");
        }
        //LIGAR
        $this->ligar();

        //comunicar
        try {
            // comunicação com bd
            if (!empty($parametros)) {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute($parametros);
            } else {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
            }
        } catch (PDOException $e) {
            // caso exista erro
            return false;
        }
        //desligar a bd
        $this->desligar();
    }
}
