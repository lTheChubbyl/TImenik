<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="css.css">
		<script src="jq.js"></script>
	</head>

	<body>
		<div class="nav">
			<ul>
				<li><a href="index.php">Imenik</a></li>
				<li><a href="vt.php">Važni Telefoni</a></li>
				<li><a href="ku.php">Korisničko Uputstvo</a></li>
			</ul>
		</div> 

		<div class="search">
			<form method="POST">
				<input type="text" id="ime" name="ime" placeholder="IME">
				<input type="text" id="prezime" name="prezime" placeholder="PREZIME">
				<input type="text" id="adresa" name="adresa" placeholder="ADRESA">
				<select name="mesto" id="mesto">
					<option value="Izaberi">Izaberi...</option>
					<option value="Pančevo">PANČEVO</option>
					<option value="Beograd">BEOGRAD</option>
					<option value="Novi Sad">NOVI SAD</option>
				</select>
				<input type="text" id="br" name="brojt" placeholder="BROJ TELEFONA">
				<div class="btn">
					<input type="submit" name="btn" value="Traži">
				</div>
			</form>
		</div>

		<div class="result">
			<?php 
			$name = $surname = $address = $place = $number = "";
			$x= 0;
			$array = array();
				$t= fopen("imenik.txt", "r") or die("Nope");
					while (!feof($t)) 
					{
					 	$array[$x]= fgets($t);
					 	$array[$x]= explode(" | ", $array[$x]);
					 	$x++;
					}
					fclose($t);

				if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['ime'], $_POST['prezime'], $_POST['adresa'], $_POST['mesto'], $_POST['brojt']))
				{ 
				?>
					<table id="tableres" class="tableres">	
						<tr class="header">
							<th>Šifra</th>
							<th>Ime</th>
							<th>Prezime</th>
							<th>Adresa</th>				
							<th>Mesto</th>					
							<th>Br.Tel.</th>
							<th>E-mail</th>					
						</tr>
				<?php
					$name=$_POST['ime'];
					$surname=$_POST['prezime'];
					$address=$_POST['adresa'];
					$place=$_POST['mesto'];
					$number=$_POST['brojt'];
					for ($i=0; $i<$x; $i++)
					{
					$namecheck = $surnamecheck = $addresscheck = $placecheck = $numbercheck = false;
						if (!empty($name))
						{
							if (strpos($array[$i][1], $name) !==false)
							{
								$namecheck= true;
							}
						}
						else
						{
							$namecheck= true;
						}

						if (!empty($surname))
						{
							if (strpos($array[$i][2], $surname) !==false)
							{
								$surnamecheck= true;
							}
						}
						else
						{
							$surnamecheck= true;
						}

						if (!empty($address))
						{
							if (strpos($array[$i][3], $address) !==false)
							{
								$addresscheck= true;
							}
						}
						else
						{
							$addresscheck= true;
						}

						if ($place!="Izaberi") 
						{
							if (strpos($array[$i][4], $place) !==false)
							{
								$placecheck= true;
							}
						}
						else
						{
							$placecheck= true;
						}

						if (!empty($number))
						{
							if (strpos($array[$i][5], $number) !==false)
							{
								$numbercheck= true;
							}
						}
						else
						{
							$numbercheck= true;
						}

						if ($namecheck== true && $surnamecheck== true && $addresscheck== true && $placecheck== true && $numbercheck== true)
						{
						?>
							<tr>
								<td><?php echo $array[$i][0]; ?></td>
								<td><?php echo $array[$i][1]; ?></td>
								<td><?php echo $array[$i][2]; ?></td>
								<td><?php echo $array[$i][3]; ?></td>
								<td><?php echo $array[$i][4]; ?></td>
								<td><?php echo $array[$i][5]; ?></td>
								<td><?php echo $array[$i][6]; ?></td>
							</tr>
						<?php
						}
					}
				}
			?>		 
			</table>
		</div>
	</body>
</html>