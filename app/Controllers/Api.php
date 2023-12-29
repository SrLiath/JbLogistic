<?php

namespace App\Controllers;

class Api extends BaseController
{
    public function apirastreio()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Conecta-se ao banco de dados
            $db = \Config\Database::connect();

            // Verifica se a conexão foi bem-sucedida
            if ($db->connect_errno) {
                die("Falha na conexão: " . $db->connect_error);
            }

            // Obtém o código fornecido no método POST
            $codigo = $_POST['valor'];

            if($codigo == "") {
                $db->close();
            } else {
                $sql = 'SELECT id, status FROM pedidos WHERE rastreio = ?';
                $query = $db->query($sql, [$codigo]);
                // Exibe os resultados da consulta
                foreach ($query->getResult() as $row) {
                    echo $row->id . " - " . $row->status . "<br>";
                }

                // Fecha a conexão com o banco de dados
                $db->close();
            }
        }
    }

    public function apilc()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = \Config\Database::connect();

            if (isset($_POST['conf']) && $_POST['conf'] == 1) {

                $cpf = $_POST['cpf'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

                if ($cpf == "" || $nome == "" || $email == "" || $pass == "") {
                    echo "preencha corretamente";
                } else {
                    $telefone =str_replace(array(".", "-", " ","(",")"), "", $_POST['telefone']);
                    // Remove pontos e traços do CPF
                    $src = str_replace(array(".", "-"), "", $_POST['cpf']);

                    // Consulta para verificar se o CPF já existe na tabela de usuários
                    $query_cpf = $db->query("SELECT cpf FROM usuarios WHERE cpf = ?", [$src]);

                    // Consulta para verificar se o e-mail já existe na tabela de usuários
                    $query_email = $db->query("SELECT email FROM usuarios WHERE email = ?", [$email]);

                    if ($query_cpf->getNumRows() > 0) {
                        // Se o número de linhas for maior que 0, significa que já existe uma conta com este CPF
                        echo "Já existe uma conta com este CPF";
                    } elseif ($query_email->getNumRows() > 0) {
                        // Se o número de linhas for maior que 0, significa que já existe uma conta com este e-mail
                        echo "Já existe uma conta com este e-mail";
                    }
                    // Verifica o formato do email usando regex
                    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo "O e-mail informado não é válido";
                    }
                    // Verifica o formato do CPF usando regex
                    elseif (!preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $cpf)) {
                        echo "O CPF informado não é válido";
                    } elseif (strlen($pass) < 1) {
                        echo "Escolha uma senha";
                    } else {
                        // Insere o usuário na tabela de usuários
                        $sql = 'INSERT INTO usuarios (cpf, nome, email, senha, telefone) values (?,?,?,?,?);';
                        $query = $db->query($sql, [$src,$nome,$email,$pass,$telefone]);
                        echo "cadastrado com sucesso";
                    }
                }
            } elseif (isset($_POST['conf']) && $_POST['conf'] == 2) {


                $db = \Config\Database::connect();
                $password = $_POST['password'];
                $elogin = $_POST['elogin'];
                if ($elogin == "" || $password == "") {
                    echo "preencha corretamente";
                } else {
                    $login = $db->table('usuarios')->where('email', $elogin)->countAllResults();


                    if ($login == 1) {
                        
                        $usuario = $db->table('usuarios')
                          ->getWhere(['email' => $elogin])
                          ->getRow();
                    if (password_verify($password, $usuario->senha)) {
                        $eid = $usuario->id;
                        $datasesi = [
                        'eid' => $eid,
                        'elogin' => $elogin,
                        'password' => $password,
                        ];
                        session()->set($datasesi);
                        echo "logado";
                    }
                    } else {
                        $logine = $db->table('entregadores')->where('email', $elogin)->countAllResults();
                        if ($logine == 1) {
                            $entregador = $db->table('entregadores')
                            ->getWhere(['email' => $elogin])
                            ->getRow();
                    if (password_verify($password, $entregador->senha)) {

                            $entid = $entregador->id;
                            $datasesi = [
                              'entid' => $entid,
                              'elogin' => $elogin,
                              'password' => $password,
                              ];
                            session()->set($datasesi);
                            echo "entregador";
                    }
                        } else {

                            echo "Email ou senha invalidos";
                        }

                    }
                }

            }
        }
        die();
    }

    public function apipost()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = \Config\Database::connect();
            $eid = session()->get('eid');
            $elogin = session()->get('elogin');
            $password = session()->get('password');
            $login = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->countAllResults();


            if ($login == 1) {
                $loginCheck = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->get()->getRow();
                if(password_verify($password, $loginCheck->senha)){

                $db = \Config\Database::connect();

                // Captura dos valores enviados via POST
                $local_entrega = $_POST['local_de_entrega'];
                $local_busca = $_POST['local_de_busca'];
                $descricao = $_POST['descricao'];
                $peso = $_POST['peso'];
                $tamanho_pacote = $_POST['tamanho_pacote'];
                $urgencia = $_POST['urgencia'];
                $distancia = $_POST['distancia'];
                $nome_recebedor = $_POST['nome_recebedor'];


                $destino = $local_entrega;
                $origem = $local_busca;

                // Codifique as strings de localização para que possam ser usadas na URL da API
                $origem = urlencode($origem);
                $destino = urlencode($destino);

                // Crie a URL da API do Google Maps com os locais e a chave de API
                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $origem . "&destinations=" . $destino . "&mode=driving&units=metric&key=AIzaSyDjWfywweufaGU7QzQhUuYWZZCoogOWb90";

                // Use a função cURL para fazer uma solicitação à API do Google Maps
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($curl);
                curl_close($curl);

                // Analise a resposta da API e extraia a distância entre os locais
                $resultado = json_decode($response, true);
                $distanciaa = $resultado['rows'][0]['elements'][0]['distance']['value'] / 1000;
                $a = floatval($distanciaa);
                $b = floatval($distancia);
                if ($a !== $b) {
                    echo "erro!!! contate um administrador $distancia e $distanciaa";
                    die();
                } else {
                    // Geração do código de rastreamento
                    do {
                        $rastreio = '';
                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $length = strlen($characters);

                        for ($i = 0; $i < 5; $i++) {
                            $rastreio .= $characters[rand(0, $length - 1)];
                        }

                        // Verifica se o código de rastreamento já existe na tabela
                        $query = $db->query("SELECT rastreio FROM pedidos WHERE rastreio = ?", [$rastreio]);
                        $result = $query->getResult();

                    } while (!empty($result));

                    if ($distancia <= 4) {
                        $valor = 10.9;
                    } elseif ($distancia > 10) {
                        $valor = 10.9 + (($distancia - 4) * 1.30);
                    }
                    if ($urgencia == 1) {
                        $valor = $valor*1.1;
                    }

                    $dataAtual = date('Y-m-d H:i:s'); // Formato MySQL: "aaaa-mm-dd"

                    // Inserção dos dados na tabela pedidos
                    $data = [
                        'id_usuario' => $eid,
                        'id_entregador' => null,
                        'local_de_entrega' => $local_entrega,
                        'local_de_busca' => $local_busca,
                        'descricao' => $descricao,
                        'peso' => $peso,
                        'status' => 'Aguardando confirmação',
                        'tamanho_pacote' => $tamanho_pacote,
                        'urgencia' => $urgencia,
                        'rastreio' => $rastreio,
                        'valor' => $valor,
                        'nome_recebedor' => $nome_recebedor,
                        'date' => $dataAtual
                    ];
                    $db->table('pedidos')->insert($data);

                    // Resposta para o AJAX
                    $response = [
                        'success' => true,
                        'message' => 'Pedido cadastrado com sucesso!'
                    ];
                    echo "Inserido com sucesso";
                }}else{
                    die();
                }
            } else {
                die();
            }
        }
    }
    public function apicon()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = \Config\Database::connect();
            $eid = session()->get('eid');
            $elogin = session()->get('elogin');
            $password = session()->get('password');
            if ($eid == "" || $elogin == "" || $password == "") {
                die();
                } else {
                $login = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->countAllResults();

                if ($login == 1) {
                    $loginCheck = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->get()->getRow();
                if(password_verify($password, $loginCheck->senha)){
                    

                    $pedidos = $db->table('pedidos')->where('id_usuario', $eid)->where('status', 'entregue')->get()->getResult();

                    echo json_encode($pedidos);
                }else{die();}} else {
                    die();
                }
            }
        }
    }

    public function apip()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $db = \Config\Database::connect();
            $eid = session()->get('eid');
            $elogin = session()->get('elogin');
            $password = session()->get('password'); 
            if ($eid == "" || $elogin == "" || $password == "") {die();}
            $login = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->countAllResults();


            if ($login == 1) {
            $loginCheck = $db->table('usuarios')->where('email', $elogin)->where('id', $eid)->get()->getRow();
             if(password_verify($_POST['senha'], $loginCheck->senha)){
                if(isset($_POST['choice'])){
                    $pass = $_POST['choice'];
                    #aqui verifica se foi selecionado alterar a senha
                    if ($pass === "pass"){
                        $senha = $_POST['senha'];
                        $newsenha = password_hash($_POST['newsenha'], PASSWORD_BCRYPT);
                        $check = $db->table('usuarios')->where('email', $elogin)->get()->getRow();
                       if(password_verify($senha, $check->senha)){ 
                       $builder = $db->table('usuarios');
                        $data = ['senha' => $newsenha];
                        $builder->where('email', $elogin);
                        $builder->update($data);
                        echo "alterado com sucesso";}
                        else {echo "senha incorreta";};
                        die();
    
                    }
                }

                $confirm = $_POST['confirm'];
                if ($confirm == "1") {
                } else {
                    $id = $_POST['id'];
                    $db->query("UPDATE pedidos SET status = 'cancelado' WHERE id = ?", [$id]);
                }
            }else {echo "senha incorreta";};
        }
        }
    }



}
