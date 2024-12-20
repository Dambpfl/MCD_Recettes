<?php

 try {
    // On se connecte à MySQL
    $mysqlClient = new PDO('mysql:host=localhost;dbname=recipe_demo;charset=utf8', 'root', '');
} catch (Exception $e) {
    // En cas d'erreur, on affiche un message et on arrête tout
    die('Erreur : ' . $e->getMessage());
}

// On récupère tout le contenu de la table recipes
$sqlQuery = 'SELECT recipe.id_recipe, recipe.recipe_name, recipe.preparation_time, category.category_name  -- ne pas oublié l id --
             FROM recipe
             INNER JOIN category ON category.id_category = recipe.id_category
             ORDER BY preparation_time DESC';
$recipesStatement = $mysqlClient->prepare($sqlQuery);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll(); // va chercher all

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border = 10>
        <thead>
            <tr>
                <th>Recette</th>
                <th>Temps de préparation</th>
                <th>catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($recipes as $recipe) {?>
            <tr>
                <td><a href="detailRecette.php?id=<?php echo $recipe["id_recipe"] ?>"><?php echo $recipe['recipe_name']; ?></a></td> <!-- echo de id obligatoire sinon pas de changement dans l'URL -->
                <td><?php echo $recipe['preparation_time']; ?></td>
                <td><?php echo $recipe['category_name']; ?></td>
            </tr> <?php } ?>
        </tbody>
    </table>
</body>
</html>