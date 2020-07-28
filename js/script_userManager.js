var addButton = document.querySelector(".icon-user-plus");
addButton.addEventListener("click",function(){
	//lastUserId is defined in userManager.php near footer
	var currId = lastUserId + 1;
	lastUserId = currId;
	
	var addButtonRow = document.querySelector(".addUserButtonRow");
	addButtonRow.remove();
	var table = document.querySelector(".userEditTable tbody");
	const newRow = document.createElement('tr');
	newRow.innerHTML = `
		<td>
			<input type="hidden" name="newUserId[`+currId+`]" />
			<input type="text" name="newUserName[`+currId+`]"/>
		</td>
		<td><input type="text" name="newUserFullname[`+currId+`]"/></td>
		<td><input type="text" name="newUserPassword[`+currId+`]"/></td>
		<td>
		<select name="newUserAccountType[`+currId+`]" >
			<option value="pracownik">
				pracownik
			</option>
			<option value="koordynator" >
				koordynator
			</option>410,
			<option value="kierownik" >
				kierownik
			</option>
			<option value="archiwum">
				archiwum
			</option>
			<option value="korespondencja">
				korespondencja
			</option>
			<option value="dyrektor" >
				dyrektor
			</option>
			<option value="admin">
				administrator
			</option>
		</select>
		</td>
		<td><input type="text" name="newUserWorkerGroup[`+currId+`]" /></td>
		<td><input type="checkbox" name="newDeleteUser[`+currId+`]"/></td>
	`;
	table.appendChild(newRow);
	table.appendChild(addButtonRow);
} );