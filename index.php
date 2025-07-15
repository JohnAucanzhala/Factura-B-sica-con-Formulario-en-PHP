<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Generador de Factura</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
  <h2 class="mb-4">Formulario de Facturación</h2>
  <form action="procesar.php" method="POST">
    
    <h4>Datos del Cliente</h4>
    <div class="mb-3">
      <label class="form-label">Nombre:</label>
      <input type="text" name="nombre_cliente" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Correo electrónico:</label>
      <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha:</label>
      <input type="date" name="fecha" class="form-control" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Comentarios:</label>
      <textarea name="comentarios" class="form-control" rows="3"></textarea>
    </div>

    <h4>Productos</h4>

    <?php for ($i = 0; $i < 3; $i++): ?>
      <div class="border p-3 mb-3">
        <h5>Producto <?= $i + 1 ?></h5>
        <div class="mb-2">
          <label>Nombre:</label>
          <input type="text" name="producto[]" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Precio ($):</label>
          <input type="number" name="precio[]" step="0.01" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Cantidad:</label>
          <input type="number" name="cantidad[]" class="form-control" required>
        </div>
        <div class="mb-2">
          <label>Categoría:</label>
          <select name="categoria[]" class="form-select" required>
            <option value="Electrónica">Electrónica</option>
            <option value="Ropa">Ropa</option>
            <option value="Alimentos">Alimentos</option>
          </select>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="iva[]" value="<?= $i ?>" id="iva<?= $i ?>">
          <label class="form-check-label" for="iva<?= $i ?>">Aplicar IVA (15%)</label>
        </div>
      </div>
    <?php endfor; ?>

    <button type="submit" class="btn btn-primary">Generar Factura</button>
  </form>
</div>
</body>
</html>
