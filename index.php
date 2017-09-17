<?php

require_once("config.php");
/*
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo json_encode($usuarios);
*/

// Carrega um usuario
/*
$root = new Usuario();
$root->loadByid(2); // returna o usuario 2
echo $root;
*/

// CArrega uma lista de usuarios
//$lista = Usuario::getList();
//echo json_encode($lista); // Toda lista mostra em um json

// Carrega uma lista de usuarios pesquisando pelo nome com like 
//$busca = Usuario::busca("jo"); // traz joao e jose
//echo json_encode($busca); // Toda lista mostra em um json

// Carrega um usuario usando login e senha
$usuario = new Usuario();
$usuario->login("robson","123"); // retorna o robson
echo $usuario;


?>
