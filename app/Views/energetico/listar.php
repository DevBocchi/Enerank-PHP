<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Favorites Engergy Drinks</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<h1 class="page-title">Energéticos Avaliados</h1>

<div class="card-grid">
    <?php foreach ($energeticos as $i => $dados): ?>
        <div class="energy-card">

            <div class="card-can">
                <img src="assets/img/monster-fake-<?= ($i % 3) + 1 ?>.png" alt="Lata de energético">
            </div>

            <div class="card-field">
                <span class="label">Marca :</span>
                <span class="value-box"><?= $dados['marca'] ?></span>
            </div>

            <div class="card-field">
                <span class="label">Nome :</span>
                <span class="value-box"><?= $dados['nome'] ?></span>
            </div>

            <div class="card-field">
                <span class="label">Sabor :</span>
                <span class="value-box"><?= $dados['sabor'] ?></span>
            </div>

            <div class="card-field">
                <span class="label">Nota :</span>
                <span class="card-stars">
                <?php for ($s = 1; $s <= 5; $s++): ?>
                    <?= $s <= $dados['nota'] ? '★' : '☆' ?>
                <?php endfor; ?>
            </span>
            </div>

            <div class="card-zero">
                <span class="check-box<?= $dados['zero'] ? ' checked' : '' ?>"><?= $dados['zero'] ? '✓' : '' ?></span>
                Zero Açúcar?
            </div>

            <div class="card-actions">
                <form method="POST">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" value="<?= $dados['id'] ?>">
                    <button type="submit">Excluir</button>
                </form>

                <a href="editarEnergetico.php?id=<?= $dados['id'] ?>">Editar</a>
            </div>

        </div>
    <?php endforeach; ?>
</div>
<a href="criarEnergetico.php" class="btn-pill">Adicinar Energetico</a>
</body>
</html>