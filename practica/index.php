<?php
    include 'source/Application.php';
?>
<html>
	<head>
		<link rel="stylesheet" href="assets/bootstrap.min.css"/>
	</head>
	<body>
		<div class="container" style="margin-top: 50px;">
			<div class="row ">
				<div class="col-lg-4"></div>
				<div class="col-lg-4 text-center">
					<form>
					    <div class="form-group">
						     <h1>Generador de Comprobantes</h1>
                             <input type="number" class="form-control" name="quantity" placeholder="Cantidad de archivos" required>
					    </div>
					    <button type="submit" class="btn btn-danger">Generar</button>
					</form>
				</div>
				<div class="col-lg-4"></div>
			</div>
            <div class="row ">
                <?php
                    Application::Execute();
                ?>
			</div>
		</div>
	</body>

</html>
<?php
/**
 * Created by Santiago RG.
 * User: Asus X452E A4
 * Date: 13/11/2015
 * Time: 11:03
 */
