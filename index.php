<?php 
echo "<meta charset='utf-8'>";
set_time_limit(0);

$conn = new mysqli("localhost", "root", "", "db_bolsafamilia");

$ufs = array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RO", "RS", "RR", "SC", "SE", "SP", "TO");

foreach ($ufs as $key => $value) {
	$sql = "SELECT * FROM(
	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201501_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201502_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201503_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201504_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201505_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201506_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201507_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201508_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201509_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201510_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201511_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	UNION ALL

	SELECT UF, Nome_Municipio_SIAFI, COUNT(Nome_Beneficiario) AS QTD, SUM(Valor_Beneficio) AS Soma, Ano_MesReferencia
	FROM 201512_bolsafamilia_pagamentos
	WHERE UF = '$value'
	GROUP BY Nome_Municipio_SIAFI

	) AS b ORDER BY Ano_MesReferencia ASC";


$qr = mysqli_query($conn, $sql);

$arquivo = 'BolsaFamilia.xls';
header ('Cache-Control: no-cache, must-revalidate');
header ('Pragma: no-cache');
header('Content-Type: application/x-msexcel');
header ("Content-Disposition: attachment; filename=\"{$arquivo}\"");

echo '<table border=1>';
echo '<tr>';
echo '<td>UF</td>';
echo '<td>MUNICÍPIO_SIAFI</td>';
echo '<td>QTD. PAG.</td>';
echo '<td>TOTAL</td>';
echo '<td>MÊS</td>';
echo '<td>ANO</td>';
echo '</tr>';

while ($reg = mysqli_fetch_assoc($qr)) {
	echo '<tr>';
	echo '<td>'. $reg['UF'] .'</td>';
	echo '<td>'. utf8_encode($reg['Nome_Municipio_SIAFI']) .'</td>';
	echo '<td>'. $reg['QTD'] .'</td>';
	echo '<td>'. number_format($reg['Soma'],0,",",".") .'</td>';
	echo '<td>'. substr($reg['Ano_MesReferencia'], -2) .'</td>';
	echo '<td>'. substr($reg['Ano_MesReferencia'], 0, 4) .'</td>';
}

echo '</table>';

}
 ?>