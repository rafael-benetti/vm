<?php

$html = '
		<img src="http://vmsys.online/assets/img/logo-min.png" max-width= "10%" alt="Logo">
                
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

			foreach($all_users as $row):
			$html .= '		
				<tr class="oddrow">
					<td>'.$row['username'].'</td>
					<td>'.$row['firstname'].'</td>
					<td>'.$row['lastname'].'</td>
					<td>'.$row['email'].'</td>
					<td>'.$row['mobile_no'].'</td>
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

		$filename = 'users_list1';

		ob_clean();

		$mpdf->Output($filename . '.pdf', 'D');

		exit();
                

?>