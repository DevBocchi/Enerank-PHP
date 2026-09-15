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
<div class="wavy-bg"></div>

<h1 class="page-title">Avalie o Energético</h1>

<section class="review-section">
    <form method="POST" class="review-form" action="index.php?rota=store">

        <div class="field-row">
            <label>Marca :</label>
            <input type="text" name="marca" placeholder="">
        </div>

        <div class="field-row">
            <label>Nome :</label>
            <input type="text" name="nome" placeholder="">
        </div>

        <div class="field-row">
            <label>Sabor :</label>
            <input type="text" name="sabor" placeholder="">
        </div>

        <div class="field-row">
            <label>Nota :</label>
            <div class="star-rating">
                <input type="radio" id="nota5" name="nota" value="5" required><label for="nota5">★</label>
                <input type="radio" id="nota4" name="nota" value="4"><label for="nota4">★</label>
                <input type="radio" id="nota3" name="nota" value="3"><label for="nota3">★</label>
                <input type="radio" id="nota2" name="nota" value="2"><label for="nota2">★</label>
                <input type="radio" id="nota1" name="nota" value="1"><label for="nota1">★</label>
            </div>
        </div>

        <div class="zero-row">
            <label>
                <input type="checkbox" name="zero" value="1"> Zero Açúcar?
            </label>
        </div>

        <button type="submit" class="btn-pill">Enviar</button>

    </form>

    <div class="review-can">
        <img src="assets/img/monster-fake-1.png" alt="Lata de energético">
    </div>
</section>

</body>
</html>