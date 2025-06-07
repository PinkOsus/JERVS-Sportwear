<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROCESS</title>
</head>
<body>
    <div class="stage-selector">
    <h2>Select Production Stage</h2>
    <form action="#" method="post">
      <select name="production_stage" required>
        <option value="">-- Choose Stage --</option>
        <option value="quality_check">Printing</option>
        <option value="packaging">Heat Press</option>
        <option value="shipping">Sewing</option>
        <option value="delivered">Ready</option>
      </select>
      <button type="submit">Confirm</button>
    </form>
    <a href="../../Controller/factory_logout.php">LOGOUT</a>
</body>
</html>