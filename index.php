<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="centrar">
<?php
// Conectar a la base de datos
try {
    $pdo = new PDO('mysql:host=localhost;dbname=qr_policia', 'root', ''); // Reemplaza 'usuario' y 'contraseña' por tus credenciales
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error al conectar a la base de datos: ' . $e->getMessage());
}

// Obtener el ID del policía de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Consultar la base de datos
    $stmt = $pdo->prepare('SELECT * FROM datos_policia WHERE id = :id');
    $stmt->execute(['id' => $id]);
    $policia = $stmt->fetch(PDO::FETCH_ASSOC);

    // Mostrar los datos
    if ($policia) {
        echo '<h1>Datos del Policía</h1>';
        echo '<p>Nombre: ' . htmlspecialchars($policia['nombre']) . '</p>';
        echo '<p>Cédula: ' . htmlspecialchars($policia['cedula']) . '</p>';
        echo '<p>Categoría: ' . htmlspecialchars($policia['categoria']) . '</p>';
        echo '<p>Estado: ' . htmlspecialchars($policia['estado']) . '</p>';
    } else {
        echo 'No se encontraron datos.';
    }
} else {
    echo 'Error: Parámetro "id" no proporcionado en la URL.';
}
?>
    </div>
</body>
</html>
