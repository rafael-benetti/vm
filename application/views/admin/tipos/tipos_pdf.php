<?php

$html = '
		<img src="http://vmsis.altechindustria.com.br/assets/img/067d265a8fb3ff0d582de88d66b8f02b.png" alt="Logo">
		<h3>Lista de Usuários</h3>
		<table border="1" cellspacing="0" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Tipo</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_tipos as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['tipo'].'</td>
					<td>'.$row['created_at'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
				
		$mpdf = new mPDF('c');

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Light Admin - Users List");
		$mpdf->SetAuthor("Altech");
		$mpdf->watermark_font = 'Altech';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'tipos_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>