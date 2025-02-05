<!DOCTYPE html>
<html lang="hr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trgovina auto-dijelova</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<?php
// Definiranje podataka
$cijena = 25; // Osnovna cijena (integer)
$popust = 15.5; // Popust u procentima (float)
$naziv = "Filter ulja"; // Naziv proizvoda (string)
$na_stanju = true; // Dostupnost proizvoda (boolean)

// Definiranje konstante
define("PDV", 25); // PDV u procentima

// Izračun cijene nakon popusta (bez reference!)
$cijena_nakon_popusta = $cijena - ($cijena * $popust / 100);
$cijena_nakon_zaokruzivanja=round($cijena_nakon_popusta, 2);
// Prvi prikaz tablice
echo "<h2>Trgovina auto-dijelova</h2>";
echo "<table>";
echo "<tr><th>Naziv dijela</th><td>$naziv</td></tr>";
echo "<tr><th>Osnovna cijena</th><td>$cijena €</td></tr>";
echo "<tr><th>Popust</th><td>$popust %</td></tr>";
echo "<tr><th>Cijena nakon popusta</th><td>$cijena_nakon_zaokruzivanja €</td></tr>";
echo "<tr><th>Dostupnost</th><td>" . ($na_stanju ? "Na stanju" : "Nema na stanju") . "</td></tr>";
echo "<tr><th>PDV</th><td>" . PDV . " %</td></tr>";
echo "</table>";

// Sada mijenjamo osnovnu cijenu
$cijena = 30;

// Ponovno računamo cijenu nakon popusta
$cijena_nakon_popusta = $cijena - ($cijena * $popust / 100);


?>

</body>
</html>
