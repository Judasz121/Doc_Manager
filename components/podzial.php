<table class="userDocList">
		<tbody>
		<tr>
			<td>
			<a href="?progressTableOrderby=userName&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "userName" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder'];
						if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
				Pracownik
				<?php if($_GET['progressTableOrderby'] == "userName" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
				elseif($_GET['progressTableOrderby'] == "userName" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a>
			</td>
			<td><div data-tooltip="Ilość Sprawa Przydzielonych">
			<a href="?progressTableOrderby=PdocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder'];
						if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
				  P  
				<?php if($_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
				elseif($_GET['progressTableOrderby'] == "PdocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a></div>
			</td>
			<td><div data-tooltip="Sprawy zatrzymane przez Pracownika">
			<a href="?progressTableOrderby=ZdocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "ZdocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder'];
						if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
				  Z  
				<?php if($_GET['progressTableOrderby'] == "ZdocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
				elseif($_GET['progressTableOrderby'] == "ZdocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a></div>
			</td>
			<td><div data-tooltip="Wielkość Referatu">
			<a href="?progressTableOrderby=PplusZ&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "PplusZ" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder'];
						if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
				  Ref  
				<?php if($_GET['progressTableOrderby'] == "PplusZ" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
				elseif($_GET['progressTableOrderby'] == "PplusZ" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a></div></td>
			<td><div data-tooltip="Ogólna suma wykonanych spraw">
			<a href="?progressTableOrderby=allDocsNum&progressTableOrder=<?php if( isset($_GET['progressTableOrderby']) && $_GET['progressTableOrderby'] == "allDocsNum" && $_GET['progressTableOrder'] == "ASC") echo 'DESC'; else echo 'ASC'; ?>
				<?php 	if(isset($_GET['orderby'])) echo '&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
						if(isset($_GET['clientTableOrderby'])) echo '&clientTableOrderby='.$_GET['clientTableOrderby'].'&clientTableOrder='.$_GET['clientTableOrder'];
						if(isset($_GET['page'])) echo '&page='.$_GET['page']; ?>">
				Suma W
				<?php if($_GET['progressTableOrderby'] == "allDocsNum" && $_GET['progressTableOrder'] == 'ASC') echo '<i class="icon-up-dir"></i>';
				elseif($_GET['progressTableOrderby'] == "allDocsNum" && $_GET['progressTableOrder'] == 'DESC') echo '<i class="icon-down-dir"></i>'; ?>
			</a></div>
			</td>
		</tr>
		<?php
			CountNumofDocsbyTypeForUsersTable($users);

			if(!isset($_GET['progressTableOrder']))
				$sql = 'SELECT * FROM users WHERE accountType="pracownik" OR accountType="koordynator" ORDER BY id ASC';
			else
				$sql = 'SELECT * FROM users WHERE accountType="pracownik" OR accountType="koordynator" ORDER BY '.$_GET['progressTableOrderby'].' '.$_GET['progressTableOrder'];
			$result = mysqli_query($conn, $sql);

			if ($result->num_rows > 0) {
				while($user = $result->fetch_assoc()) {
				echo '<tr><td style="';
				if($user['PdocsNum'] <= $PPsuma) echo'background-color:'.$kolor1.''; 
				elseif($user['PdocsNum'] == $PPsuma+1) echo'background-color:'.$kolor2.''; 
				elseif($user['PdocsNum'] == $PPsuma+2) echo'background-color:'.$kolor3.''; 
				elseif($user['PdocsNum'] == $PPsuma+3) echo'background-color:'.$kolor4.''; 
				elseif($user['PdocsNum'] == $PPsuma+4) echo'background-color:'.$kolor5.''; 
				elseif($user['PdocsNum'] == $PPsuma+5) echo'background-color:'.$kolor6.''; 
				elseif($user['PdocsNum'] == $PPsuma+6) echo'background-color:'.$kolor7.'';
				elseif($user['PdocsNum'] == $PPsuma+7) echo'background-color:'.$kolor8.'';
				elseif($user['PdocsNum'] == $PPsuma+8) echo'background-color:'.$kolor9.'';
				elseif($user['PdocsNum'] == $PPsuma+9) echo'background-color:'.$kolor10.'';
				elseif($user['PdocsNum'] == $PPsuma+10) echo'background-color:'.$kolor11.'';
				elseif($user['PdocsNum'] == $PPsuma+11) echo'background-color:'.$kolor12.'';
				elseif($user['PdocsNum'] == $PPsuma+12) echo'background-color:'.$kolor13.'';
				elseif($user['PdocsNum'] == $PPsuma+13) echo'background-color:'.$kolor14.'';
				elseif($user['PdocsNum'] == $PPsuma+14) echo'background-color:'.$kolor15.'';
				elseif($user['PdocsNum'] == $PPsuma+15) echo'background-color:'.$kolor16.'';
				elseif($user['PdocsNum'] == $PPsuma+16) echo'background-color:'.$kolor17.'';
				elseif($user['PdocsNum'] == $PPsuma+17) echo'background-color:'.$kolor18.'';
				elseif($user['PdocsNum'] == $PPsuma+18) echo'background-color:'.$kolor19.'';
				elseif($user['PdocsNum'] == $PPsuma+19) echo'background-color:'.$kolor20.'';
				elseif($user['PdocsNum'] == $PPsuma+20) echo'background-color:'.$kolor21.'';
				elseif($user['PdocsNum'] == $PPsuma+21) echo'background-color:'.$kolor22.'';
				elseif($user['PdocsNum'] == $PPsuma+22) echo'background-color:'.$kolor23.'';
				elseif($user['PdocsNum'] == $PPsuma+23) echo'background-color:'.$kolor24.'';
				elseif($user['PdocsNum'] == $PPsuma+24) echo'background-color:'.$kolor25.'';
				elseif($user['PdocsNum'] == $PPsuma+25) echo'background-color:'.$kolor26.'';
				elseif($user['PdocsNum'] == $PPsuma+26) echo'background-color:'.$kolor27.'';
				elseif($user['PdocsNum'] == $PPsuma+27) echo'background-color:'.$kolor28.'';
				elseif($user['PdocsNum'] == $PPsuma+28) echo'background-color:'.$kolor29.'';
				elseif($user['PdocsNum'] == $PPsuma+29) echo'background-color:'.$kolor30.'';
				elseif($user['PdocsNum'] > $PPsuma+30) echo'background-color:'.$kolor30.'';
				echo' color:black;">'.$user['userName'].'</td>';
				/////Dodanie kolejnego uzytkownika który nie ma być liczony w tabeli referatu - dopisanie kolejnego wiersza> $user['userName'] == "Inicjał" ||   < tak samo niżej
				if ($user['userName'] == "DS" ||
				$user['userName'] == "DSO" || 
				$user['userName'] == "ROL" ||
				$user['userName'] == "PO" ||
				$user['userName'] == "BC" ||
				$user['userName'] == "DM" ||
				$user['userName'] == "IP" ||
				$user['userName'] == "MJ" ||
				$user['userName'] == "AST" ||
				$user['userName'] == "LP" ||
				$user['userName'] == "MW" ||
				$user['userName'] == "EC" ||
				$user['userName'] == "JW" ||
				$user['userName'] == "JG" ||
				$user['userName'] == "MKW"
				)  echo '<td style="background: white; color:black;">---</td>';
				else echo '<td style="background: yellow; color:black;">'.$user['PdocsNum'].'</td>';
				/////Dodanie kolejnego uzytkownika który nie ma być liczony w tabeli referatu - dopisanie kolejnego wiersza> $user['userName'] == "Inicjał" ||   < tak samo niżej
				if ($user['userName'] == "DS" ||
				$user['userName'] == "DSO" || 
				$user['userName'] == "ROL" ||
				$user['userName'] == "PO" ||
				$user['userName'] == "BC" ||
				$user['userName'] == "DM" ||
				$user['userName'] == "IP" ||
				$user['userName'] == "MJ" ||
				$user['userName'] == "AST" ||
				$user['userName'] == "LP" ||
				$user['userName'] == "MW" ||
				$user['userName'] == "EC" ||
				$user['userName'] == "JW" ||
				$user['userName'] == "JG" ||
				$user['userName'] == "MKW"
				)  echo '<td style="background: white; color:black;">---</td>';
				else echo '<td style="background: orange; color:black;">'.$user['ZdocsNum'].'</td>';
				echo '<td>';
				/////Dodanie kolejnego uzytkownika który nie ma być liczony w tabeli referatu - dopisanie kolejnego wiersza> $user['userName'] == "Inicjał" ||   < tak samo niżej
				if ($user['userName'] == "DS" ||
				$user['userName'] == "DSO" || 
				$user['userName'] == "ROL" ||
				$user['userName'] == "PO" ||
				$user['userName'] == "BC" ||
				$user['userName'] == "DM" ||
				$user['userName'] == "IP" ||
				$user['userName'] == "MJ" ||
				$user['userName'] == "AST" ||
				$user['userName'] == "LP" ||
				$user['userName'] == "MW" ||
				$user['userName'] == "EC" ||
				$user['userName'] == "JW" ||
				$user['userName'] == "JG" ||
				$user['userName'] == "MKW"
				) echo '---';
								
				elseif($user['PplusZ'] <= $PPsuma) echo $user['PplusZ'].' ↑'; 
				elseif($user['PplusZ'] == $PPsuma+1) echo $user['PplusZ'].' ↑'; 
				elseif($user['PplusZ'] == $PPsuma+2) echo $user['PplusZ'].' ↑'; 
				elseif($user['PplusZ'] == $PPsuma+3) echo $user['PplusZ'].' ↑'; 
				elseif($user['PplusZ'] == $PPsuma+4) echo $user['PplusZ'].' ↑'; 
				elseif($user['PplusZ'] == $PPsuma+5) echo $user['PplusZ'].' ↑'; 
				elseif($user['PplusZ'] == $PPsuma+6) echo $user['PplusZ'].' ↑';
				elseif($user['PplusZ'] == $PPsuma+7) echo $user['PplusZ'].' ↑';
				elseif($user['PplusZ'] == $PPsuma+8) echo $user['PplusZ'].' ↑';
				elseif($user['PplusZ'] == $PPsuma+9) echo $user['PplusZ'].' ↑';
				elseif($user['PplusZ'] == $PPsuma+10) echo $user['PplusZ'].' ↑';
				elseif($user['PplusZ'] == $PPsuma+11) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+12) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+13) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+14) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+15) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+16) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+17) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+18) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+19) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+20) echo $user['PplusZ'].' ↔';
				elseif($user['PplusZ'] == $PPsuma+21) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+22) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+23) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+24) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+25) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+26) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+27) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+28) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] == $PPsuma+29) echo $user['PplusZ'].' ↓';
				elseif($user['PplusZ'] > $PPsuma+30) echo $user['PplusZ'].' ↓';
				echo'</td>
				<td>';
				/////Dodanie kolejnego uzytkownika który nie ma być liczony w tabeli referatu - dopisanie kolejnego wiersza> $user['userName'] == "Inicjał" ||   < tu ostatnia zmiana
				if ($user['userName'] == "DS" ||
				$user['userName'] == "DSO" || 
				$user['userName'] == "ROL" ||
				$user['userName'] == "PO" ||
				$user['userName'] == "BC" ||
				$user['userName'] == "DM" ||
				$user['userName'] == "IP" ||
				$user['userName'] == "MJ" ||
				$user['userName'] == "AST" ||
				$user['userName'] == "LP" ||
				$user['userName'] == "MW" ||
				$user['userName'] == "EC" ||
				$user['userName'] == "JW" ||
				$user['userName'] == "JG" ||
				$user['userName'] == "MKW"
				) echo '---';
				
				else  echo '' .$pz1=$user['allDocsNum'] - ($user['PdocsNum'] + $user['ZdocsNum']);
				echo '</td></tr>';
				}
				}



		?>
		</tbody>
	</table>