var newRowId = 1;
var form = document.querySelector("form.doc-list");
form.onsubmit = function(){
    var btn = document.querySelector("input[type=submit]:focus");
    var id = btn.getAttribute("id");
    id = id.split("e")['1'];
    btn.setAttribute("value", id);
}
function IsOdd(n){
    return Math.abs(n % 2) == 1;
}

function DuplicateRow(id, button){
    var currRow = button.parentNode.parentNode;
    var cols = [
        "clientNum",
        "clientName",
        "clientSurname",
        "yearHired",
        "dateWorkStart",
        "dateWorkEnd",
        "docType",
        "docImportance",
        "docSpace",
        "MMM",
        "progress",
        "asignedTo",
        "comments",
        "dateModified",
        "userModified",
        "userIpModified",
        "addedBy",
        "dateAdded"
    ]
    cols.forEach(function(col){
        window[col] = currRow.querySelector("div[class='"+col+"'] input").getAttribute("value");
       //doesnt work for some reason window[col] = currRow.querySelector("div[class='"+col+"'] input[name='"+col+"']").getAttribute("value");
        console.log(currRow.querySelector("div." + col).innerHTML);
    });
    for (var i=0; i < currRow.childNodes.length; i++){
        console.log(currRow.childNodes[i]);
    }
    // for (var i=0; i < currRow.childNodes.length; i++){
    //     if(i == 1 || IsOdd(i)){
    //          cols.forEach(function(col){
    //              if(currRow.childNodes[i].className == col){
    //                  window[col] = currRow.childNodes[i].innerHTML.replace(/\s/g, '');
    //              }
    //          });
    //      }
    //  }
    var newRow = `
    <div class="doc item newRow">
        <div class="clientNum">
            <input type="text" name="newRowClientNum[`+newRowId+`]" value="`+clientNum+`">
        </div>
        <div class="clientName">
            <input type="text" name="newRowClientName[`+newRowId+`]" value="`+clientName+`">
        </div>
        <div class="clientSurname">
            <input type="text" name="newRowClientSurName[`+newRowId+`]" value="`+clientSurname+`">
        </div>
        <div class="yearHired">
            <select name="newRowYearsHired[`+newRowId+`]">
            ` + SendAjaxRequest("GET", "ajax requests/yearsHiredOptions.php?selected="+yearHired, false) + `
            </select>
        </div>
        <div class="dateWorkStart">
            <input type="date" name="newRowDateWorkStart[`+newRowId+`]" value="`+dateWorkStart+`">
        </div>
        <div class="dateWorkEnd">
            <input type="date" name="newRowDateWorkEnd[`+newRowId+`]" value="`+dateWorkEnd+`">
        </div>
        <div class="docType">
            <select name="newRowDocType[`+newRowId+`]">
            ` + SendAjaxRequest("GET", "ajax requests/docTypesOptions.php?selected="+docType, false) + `
            </select>
        </div>
        <div class="docImportance">
            <select name="newRowDocImportance[`+newRowId+`]">
            ` + SendAjaxRequest("GET", "ajax requests/docImportancesOptions.php?selected="+docImportance, false) + `
            </select>
        </div>	
        <div class="docSpace" style="inline"><label>
            <select name="newRowDocSpace[`+newRowId+`]">
                ` + SendAjaxRequest("GET", "ajax requests/docSpaceOptions.php?selected=pracownik", false) + `
            </select>
        </div>
        <div class="mmm">
            <select name="newRowMMM[`+newRowId+`]" class="colorSelect">
                ` + SendAjaxRequest("GET", "ajax requests/MMMOptions.php?selected="+MMM, false) + `
            </select>
        </div>
        <div class="progress">
            <select name="newRowProgress[`+newRowId+`]">
                ` + SendAjaxRequest("GET", "ajax requests/progressOptions.php?selected=NP", false) + `
            </select>
        </div>
        <div class="asignedTo">
            <select name="newRowAsignedTo[`+newRowId+`]">
            ` + SendAjaxRequest("GET", "ajax requests/usersOptions.php?selected=NN", false) + `
            </select>
        </div>
        <div class="comments">
            <input type="text" size="10" name="newRowComment[`+newRowId+`]" value="`+comments+` - ponowiono">
        </div>
        <div class="dateModified">
            <span>Teraz</span>
        </div>
        <div class="userModified">
            ` + currUserName /*defined in footer.php*/ + `
        </div>
        <div class="userIpModified">
            ` + clientIP /* defined at the end of duplicate.php */ + `
        </div>
        <div class="userAdded">
            `+currUserName /*defined in footer.php*/ +`
        </div>
        <div class="dateAdded">
            <span>Teraz</span>
        </div>
            <center><input type="submit" name="addNewRows" value="Dodaj"></center>
        </div>
</div>`
    currRow.insertAdjacentHTML('afterEnd', newRow);
}