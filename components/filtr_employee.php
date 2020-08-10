<div class="doc filter"><!-----------------=================== FILTER ==============--------------------->
		<h1><?php echo $filtr. ' '. $employee;?></h1>
			<div class="clientNum">
				<span><?php echo $nrklienta;?></span>
				<span><input type="text" name="filterClientNum" class="filter" value="<?php if(isset($_POST['filterClientNum'])) echo $_POST['filterClientNum']; ?>"/></span>
			</div>
			<div class="clientName">
				<span><?php echo $imie;?> klienta</span>
				<span><input type="text" name="filterClientName" class="filter" value="<?php if(isset($_POST['filterClientName'])) echo $_POST['filterClientName']; ?>"/></span>
			</div>
			<div class="clientSurname">
				<span><?php echo $nazwisko;?> klienta</span>
				<span><input type="text" name="filterClientSurname" class="filter" value="<?php if(isset($_POST['filterClientSurname'])) echo $_POST['filterClientSurname']; ?>"/></span>
			</div>
			<div class="yearHired">
				<span><?php echo $rokzatrudnienia;?></span>
				<span>Od:
					<select name="filterYearHiredFrom" class="filter">
					<?php

					echo '<option '; if(empty($_POST['filterYearHiredFrom'])) echo 'selected'; echo' value="" ></option>';

					foreach($yearshired as $yearId => $row){
						echo '<option value="'.$row['year'].'" '; if ($_POST['filterYearHiredFrom'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
					}
					?>
					</select>
				</span>
				<span>Do:
					<select name="filterYearHiredTo" class="filter">
					<?php

					echo '<option '; if(empty($_POST['filterYearHiredTo'])) echo 'selected'; echo' value="" ></option>';
                    foreach($yearshired as $yearId => $row){
						echo '<option value="'.$row['year'].'" '; if ($_POST['filterYearHiredTo'] == $row['year']) echo 'selected'; echo ' >'.$row['year'].'</option>';
					}
					?>
					</select>
				</span>
			</div>
			<div class="workStartDate">
				<span><?php echo $rozpoczeciepracy;?></span>
				<span>Od: <input type="date" name="filterWorkStartDateFrom" class="filter" value="<?php if(isset($_POST['filterWorkStartDateFrom'])) echo $_POST['filterWorkStartDateFrom']; ?>"/></span>
				<span>Do: <input type="date" name="filterWorkStartDateTo" class="filter" value="<?php if(isset($_POST['filterWorkStartDateTo'])) echo $_POST['filterWorkStartDateTo']; ?>"/></span>
			</div>
			<div class="workEndDate">
				<span><?php echo $zakonczeniepracy;?></span>
				<span>Od: <input type="date" name="filterWorkEndDateFrom" class="filter" value="<?php if(isset($_POST['filterWorkEndDateFrom'])) echo $_POST['filterWorkEndDateFrom']; ?>"/></span>
				<span>Do: <input type="date" name="filterWorkEndDateTo" class="filter" value="<?php if(isset($_POST['filterWorkEndDateTo'])) echo $_POST['filterWorkEndDateTo']; ?>"/></span>
			</div>
			<div class="DocType">
				<span><?php echo $rodzajdokumentu;?></span>
				<select name="filterDocType" class="filter">
					<option value=""></option>
				<?php
                    foreach($docTypes as $docId => $row){
						echo '<option value="'.$row['docType'].'" '; if($_POST['filterDocType'] == $row['docType']) echo'selected '; echo ' >'.$row['docType'].'</option>';
					}
				?>
				</select>
			</div>
			<div class="DocImportance">
				<span><?php echo $waznoscdokumentu;?></span>
				<select name="filterDocImportance" class="filter">
					<option value=""></option>
				<?php

					foreach($docimportances as $docId => $row){
						echo '			
						<option value="'.$row['docImportance'].'" '; if($_POST['filterDocImportance'] == $row['docImportance']) echo'selected '; echo '>'.$row['docImportance'].'</option>';
					}
				?>
				</select>
			</div>
			<div class="docSpace">
				<span><?php echo $docSpace; ?></span>
				<select name="filterDocSpace" class="filter">
					<option value="" <?php if($_POST['filterDocSpace'] == "") echo 'selected'; ?>></option>

					<option value="archiwum1" <?php if($_POST['filterDocSpace'] == "archiwum1") echo 'selected'; ?>>Archiwum 1</option>
					<option value="archiwum2" <?php if($_POST['filterDocSpace'] == "archiwum2") echo 'selected'; ?>>Archiwum 2</option>
					<option value="pracownik" <?php if($_POST['filterDocSpace'] == "pracownik") echo 'selected'; ?>>Pracownik</option>
					<option value="kierownik" <?php if($_POST['filterDocSpace'] == "kierownik") echo 'selected'; ?>>Kierownik</option>
				</select>
			</div>
			<div class="MMM">
				<span><?php echo $ogien;?></span>
				<select name="filterMMM" class="filter">
					<option value=""></option>
				<?php

					foreach($MMMs as $row){
						echo '			
						<option value="'.$row['MMM'].'" '; if($_POST['filterMMM'] == $row['MMM']) echo'selected '; echo '>'.$row['MMM'].'</option>';
					}
				?>
				</select>
			</div>
			<div class="progress">
				<span><?php echo $stanwykonania;?></span>
				<select name="filterProgress" class="filter">
					<option value=""></option>
					<option value="PP"<?php if($_POST['filterProgress'] == "PP") echo'selected '; ?>>PP</option>
					<option value="P"<?php if($_POST['filterProgress'] == "P") echo'selected '; ?>>P</option>
					<option value="Z"<?php if($_POST['filterProgress'] == "Z") echo'selected '; ?>>Z</option>
					<option value="WP"<?php if($_POST['filterProgress'] == "WP") echo'selected '; ?>>WP</option>
			<!---		<option value="W"<?php if($_POST['filterProgress'] == "W") echo'selected '; ?>>W</option>
					<option value="N"<?php if($_POST['filterProgress'] == "N") echo'selected '; ?>>N</option>
			--->	</select>
			</div>
			<!---
			<div class="asignedTo">
				<span><?php echo $przypisanedo;?></span>
				<select name="filterAsignedTo" class="filter">
					<option value=""></option>
				<?php
					
						echo '<option value="'.$doc['workerAsigned'].'"'; if($_POST['filterAsignedTo'] == $doc['workerAsigned']) echo 'selected'; echo ' >'.$doc['workerAsigned'].'</option>';
									?>
					
				</select>
			</div>
			<!--
			<div class="addedBy">
				<span><?php echo $dodaneprzez;?></span>
				<select name="filteraddedBy" class="filter">
					<option value=""></option>
				<?php
					foreach($users as $userId => $user){
						echo '<option value="'.$user['userName'].'"'; if($_POST['filteraddedBy'] == $user['userName']) echo 'selected'; echo ' >'.$user['userName'].'</option>';
					}
				?>
					<option value="NN" <?php if($_POST['filteraddedBy'] == "NN") echo 'selected '; ?>>NN</option>
				</select>
			</div>--->
			
			<div class="comments">
				<span><?php echo $uwagi;?></span>
				<span><input type="text" name="filterComments" class="filter" value="<?php if(isset($_POST['filterComments'])) echo $_POST['filterComments']; ?>"/></span>
			</div>
			<!---
			<div class="dateModified">
				<span><?php echo $ostatniazmiana;?></span>
				<span>Od: <input type="datetime-local" name="filterDateModifiedFrom" class="filter" value="<?php if(isset($_POST['filterDateModifiedFrom'])) echo $_POST['filterDateModifiedFrom']; ?>"/></span>
				<span>Do: <input type="datetime-local" name="filterDateModifiedTo" class="filter" value="<?php if(isset($_POST['filterDateModifiedTo'])) echo $_POST['filterDateModifiedTo']; ?>"/></span>
				<a class="tooltip" href="#">(!)<span class="classic"><font size="1"><?php echo $opisDaty; ?></font></span></a>
			</div>
			<div class="dateAdded">
				<span><?php echo $datadodania;?></span>
				<span>Od: <input type="datetime-local" name="filterDateAddedFrom" class="filter" value="<?php if(isset($_POST['filterDateAddedFrom'])) echo $_POST['filterDateAddedFrom']; ?>"/></span>
				<span>Do: <input type="datetime-local" name="filterDateAddedTo" class="filter" value="<?php if(isset($_POST['filterDateAddedTo'])) echo $_POST['filterDateAddedTo']; ?>"/></span>
				<a class="tooltip" href="#">(!)<span class="classic"><font size="1"><?php echo $opisDaty; ?></font></span></a>
			</div> --->

			<input type="submit" name="filter" value="Filtruj" class="button"/>
			<input type="button" value="Wyczyść" class="button" onclick="ClearFilterInputs()"/>
			<!---<?php echo 'Ilość Dokumentów Spełniających Warunek: <b>'.$_SESSION['numofDocs'].'</b>';?>--->
		</div>
