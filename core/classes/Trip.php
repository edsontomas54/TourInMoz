<?php

namespace core\classes;

class Trip{


    public function regist_trip_client(){
     
        $bd= new Database();

        $paramets=[
            ':nome' => strtolower(trim($_POST['nome'])), //email nao pode conter letras menusculas! 'strtolower'
            ':email' => trim($_POST['email']),
            ':telefone' => (trim($_POST['telefone'])),
            ':indereco' => (trim($_POST['indereco'])),
            ':locali' => (trim($_POST['locali'])),
            ':visitante' => (trim($_POST['visitante'])),
            ':saida' => (trim($_POST['saida'])),
            ':chegada' => (trim($_POST['chegada'])),
           
        ];
    
        $bd->insert("
        INSERT INTO form_book  values(
        0,
        :nome,
        :email,
        :telefone,
        :indereco,
        :locali,
        :visitante,
        :chegada,
        :saida
        )
        ",$paramets);
        
        return;
    }
}