<?php
require __DIR__ . '/../partials/header.php';
?>

<h1>Criar conta</h1>

<form action="index.php?rota=usuario/store" method="POST">
    <label for="nome">Nome</label>
    <input type="text" name="nome" id="nome" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>

    <button type="submit">Cadastrar</button>
</form>

<p>Ja tem conta ? <a href="index.php/rota=login">Entrar</a></p>

<?php require __DIR__ . '/../partials/footer.php'; ?>