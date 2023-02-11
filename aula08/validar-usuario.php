<?php



include_once("config/conexao.php");

if($_POST){
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];


    $query = "SELECT * FROM tbl_acessos WHERE  usuario = '$usuario' AND senha = '$senha'";

    $consutarDados = mysqli_query($conexao, $query);
    $resultado = mysqli_fetch_all($consutarDados, MYSQLI_ASSOC);
    

    if($resultado){

        session_start();
        $_SESSION['ID_USUARIO'] = $resultado[0]['usuarioID'];
        $_SESSION['USUARIO'] = $resultado[0]['usuario'];
        $_SESSION['ID_SITUACAO'] = $resultado[0]['situacaoID'];

        $queryUsuario = "SELECT * FROM tbl_clientes WHERE idCliente = '".$_SESSION["ID_USUARIO"]."'";

        $consutarUsuario = mysqli_query($conexao, $queryUsuario);
        $resultadoUsuario = mysqli_fetch_all($consutarUsuario, MYSQLI_ASSOC);

        $_SESSION['NOME_USUARIO'] = $resultadoUsuario[0]['nomeCliente'];
        $_SESSION['SOBRENOME_USUARIO'] = $resultadoUsuario[0]['sobrenoneCliente'];


        header("Location: minha-conta.php");
        echo "Usuario encontrado";
    }else{
        echo "Usuário e/ou senha inválidos.";
    }
}else{
    header("Location: login.php");
}

?>
