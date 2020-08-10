<?php
echo '
    <option></option>
    <option value="pracownik"'; if($_REQUEST['selected'] == "pracownik") echo 'selected'; echo' >pracownik</option>
    <option value="archiwum 1"'; if($_REQUEST['selected'] == "archiwum1") echo 'selected'; echo' >archiwum 1</option>
    <option value="archiwum 2"'; if($_REQUEST['selected'] == "archiwum2") echo 'selected'; echo' >archiwum 2</option>';
?>