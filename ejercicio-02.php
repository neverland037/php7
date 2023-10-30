<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <a href="index.php">INICIO</a> <br>
    <header>
        <h1 id="centrado">Promedio de Notas</h1>
        <img src="img/promedio_notas.png" alt="Encabezado" width="50%" height="auto">
    </header>
    <?php
    $nombre = "";
    $nota1 = "";
    $nota2 = "";
    $nota3 = "";
    $nota4 = "";

    $promedio = "";
    $nota_mas_alta = "";
    $nota_mas_baja = "";
    $condicion = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los valores desde el formulario
        $nombre = $_POST["nombre"] ?? "";
        $nota1 = $_POST["nota1"] ?? "";
        $nota2 = $_POST["nota2"] ?? "";
        $nota3 = $_POST["nota3"] ?? "";
        $nota4 = $_POST["nota4"] ?? "";

        // Validar y calcular promedio
        if (!empty($nombre) && is_numeric($nota1) && is_numeric($nota2) && is_numeric($nota3) && is_numeric($nota4)) {
            // Guardar las notas en un arreglo para facilitar el cálculo
            $notas = [$nota1, $nota2, $nota3, $nota4];
            // Ordenar de forma descendente para encontrar la nota más alta y más baja
            rsort($notas);

            // Calcular el promedio con las tres mejores notas
            $promedio = array_sum(array_slice($notas, 0, 3)) / 3;

            $nota_mas_alta = $notas[0];
            $nota_mas_baja = $notas[3];

            // Determinar la condición del alumno
            $condicion = ($promedio >= 11) ? "Aprobado" : "Desaprobado";
        }
    }
    ?>
    <section>
        <form method="post" action="ejercicio-02.php">
            <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td>Alumno:</td>
                    <td colspan="4"><input type="text" name="nombre" value="<?php echo $nombre; ?>" size="70"></td>
                    <td class="error"><?php if (isset($_POST['calcular']) &&  empty($nombre)) {
                                            echo "Registre nombres";
                                        }
                                        ?></td>
                </tr>
                <tr>
                    <td colspan="6">Notas:</td>
                </tr>
                <tr>
                    <td>Nota 1:</td>
                    <td><input type="text" name="nota1" size="20px" value="<?php echo $nota1; ?>"></td>
                    <td class="error"><?php if (isset($_POST['calcular']) &&  ($nota1 < 0 || $nota1 > 20)) {
                                            echo "Error en Nota 1";
                                        }
                                        ?></td>
                    <td>Nota 2:</td>
                    <td><input type="text" name="nota2" size="20px" value="<?php echo $nota2; ?>"></td>
                    <td class="error"><?php if (isset($_POST['calcular']) &&  ($nota2 < 0 || $nota2 > 20)) {
                                            echo "Error en Nota 2";
                                        }
                                        ?></td>
                </tr>
                <tr>
                    <td>Nota 3:</td>
                    <td><input type="text" name="nota3" size="20px" value="<?php echo $nota3; ?>"></td>
                    <td class="error"><?php if (isset($_POST['calcular']) &&  ($nota3 < 0 || $nota3 > 20)) {
                                            echo "Error en Nota 3";
                                        }
                                        ?></td>
                    <td>Nota 4:</td>
                    <td><input type="text" name="nota4" size="20px" value="<?php echo $nota4; ?>"></td>
                    <td class="error"><?php if (isset($_POST['calcular']) &&  ($nota4 < 0 || $nota4 > 20)) {
                                            echo "Error en Nota 4";
                                        }
                                        ?></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="calcular" value="CALCULAR"</input></td>
                </tr>
                <tr>
                    <td colspan="4"> <!-- Colapsa la celda para que abarque 4 columnas -->
                        <?php if (isset($_POST['calcular']) && !empty($nombre) && !empty($nota1) && !empty($nota2) && !empty($nota3) && !empty($nota4)) { ?>
                            <p>Alumno: <?php echo $nombre; ?></p>
                            <p>Promedio: <?php echo number_format($promedio,2); ?></p>
                            <p>Nota más alta: <?php echo $nota_mas_alta; ?></p>
                            <p>Nota más baja: <?php echo $nota_mas_baja; ?></p>
                            <p>Condición: <?php echo $condicion; ?></p>
                        <?php } ?>

                    </td>
                </tr>
            </table>
        </form>
    </section>
    <footer>
        <h6 class="centrado">Realizado por William Manchego</h6>
    </footer>


</body>

</html>