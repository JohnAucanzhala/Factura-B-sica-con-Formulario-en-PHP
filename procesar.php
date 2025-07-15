<?php
function calcularTotalProducto($precio, $cantidad, $conIVA) {
    $subtotal = $precio * $cantidad;
    $iva = $conIVA ? $subtotal * 0.15 : 0;
    $total = $subtotal + $iva;
    return [$subtotal, $iva, $total];
}

$nombre = $_POST['nombre_cliente'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
$comentarios = $_POST['comentarios'];

$productos = $_POST['producto'];
$precios = $_POST['precio'];
$cantidades = $_POST['cantidad'];
$categorias = $_POST['categoria'];
$ivaMarcados = isset($_POST['iva']) ? $_POST['iva'] : [];

$subtotalGeneral = 0;
$totalIVA = 0;
$totalFinal = 0;

echo "<!DOCTYPE html><html lang='es'><head><meta charset='UTF-8'><title>Factura</title>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head><body>
<div class='container mt-5'><h2>Factura Generada</h2>";

echo "<p><strong>Cliente:</strong> $nombre</p>";
echo "<p><strong>Email:</strong> $correo</p>";
echo "<p><strong>Fecha:</strong> $fecha</p>";
echo "<p><strong>Comentarios:</strong> $comentarios</p>";

echo "<table class='table table-bordered mt-4'><thead class='table-dark'><tr>
<th>Producto</th><th>Categoría</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th><th>IVA</th><th>Total</th>
</tr></thead><tbody>";

foreach ($productos as $index => $nombreProducto) {
    $precio = floatval($precios[$index]);
    $cantidad = intval($cantidades[$index]);
    $categoria = $categorias[$index];
    $conIVA = in_array((string)$index, $ivaMarcados);

    list($sub, $iva, $total) = calcularTotalProducto($precio, $cantidad, $conIVA);

    $subtotalGeneral += $sub;
    $totalIVA += $iva;
    $totalFinal += $total;

    echo "<tr>
      <td>$nombreProducto</td>
      <td>$categoria</td>
      <td>$" . number_format($precio, 2) . "</td>
      <td>$cantidad</td>
      <td>$" . number_format($sub, 2) . "</td>
      <td>$" . number_format($iva, 2) . "</td>
      <td>$" . number_format($total, 2) . "</td>
    </tr>";
}

echo "</tbody></table>";

echo "<h4>Resumen</h4>";
echo "<p><strong>Subtotal general:</strong> $" . number_format($subtotalGeneral, 2) . "</p>";
echo "<p><strong>Total IVA:</strong> $" . number_format($totalIVA, 2) . "</p>";
echo "<p><strong>Total a pagar:</strong> $" . number_format($totalFinal, 2) . "</p>";

echo "<a href='index.php' class='btn btn-secondary mt-3'>Volver</a>";
echo "</div></body></html>";
?>
