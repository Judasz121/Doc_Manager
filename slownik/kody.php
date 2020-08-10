////kod na zmianę użytkowniak w employee.php

<p hidden class="docData'.$currId.'">'.$doc['workerAsigned'].'</p>
					<select name="asignedTo['.$currId.']" class="hidden docInput'.$currId.'">';
						foreach($users as $worker){
							echo '<option value="'.$worker['userName'].'"'; if($doc['workerAsigned'] == $worker['userName']) echo'selected'; echo ' >'.$worker['userName'].'</option>';
						}
						echo'
						<option value="NN"'; if($doc['workerAsigned'] == "NN") echo 'selected'; echo' >NN</option>
					</select>
//////////////
popup div

<div data-tooltip="Hi, I'm a tooltip. Pretty easy uh ? ;)"</div>

///////////////////employee usuwanie
<div class="deleteSelected" >
					<input type="checkbox" name="deleteSelected['.$currId.']"  />
				</div>