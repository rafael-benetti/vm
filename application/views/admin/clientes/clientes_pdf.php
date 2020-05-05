<?php

$html = '
		<img src="http://vmsis.altechindustria.com.br/assets/img/067d265a8fb3ff0d582de88d66b8f02b.png" alt="Logo">
		<h3>Lista de Usuários</h3>
		<table border="1" cellspacing="0" style="width:100%">
			<thead>
				<tr class="headerrow">
					<th>Username</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Mobile Number</th>
					<th>Created Date</th>
				</tr>
			</thead>
			<tbody>';

			foreach($all_clientes as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['clienteusername'].'</td>
					<td>'.$row['clientename'].'</td>
					<td>'.$row['sobrenome'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['fone'].'</td>
					<td>'.$row['created_at'].'</td>
				</tr>';
			endforeach;

			$html .=	'</tbody>
			</table>			
		 ';
				
		$mpdf = new mPDF('c');

		$mpdf->SetProtection(array('print'));
		$mpdf->SetTitle("Light Admin - Clientes List");
		$mpdf->SetAuthor("Altech");
		$mpdf->watermark_font = 'Altech';
		$mpdf->watermarkTextAlpha = 0.1;
		$mpdf->SetDisplayMode('fullpage');		 
		 

		$mpdf->WriteHTML($html);

		$filename = 'clientes_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();

?>