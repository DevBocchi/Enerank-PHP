<?php
require __DIR__ . '/../partials/header.php';
?>

<h1>Entrar</h1>

<?php if(isset($_GET['erro'])):?>
    <p style="color: red;">Email ou senha invalidos. </p>
<?php endif ?>

<form action="index.php?rota=login/autenticar" method="POST">
    <label for="email">Email</label>
    <input type="email" name="email" id="email" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>

    <button type="submite">Entrar</button>
</form>

<p>Nao tem conta ? <a href="index.php?rota=register">Cadastrar</a></p>

<?php require __DIR__ . "/../partials/footer.php";?>