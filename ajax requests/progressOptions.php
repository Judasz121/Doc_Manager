<?php
echo '
    <option value="N"'; if($_REQUEST['selected'] == "N") echo 'selected'; echo' >N</option>
    <option value="NP"'; if($_REQUEST['selected'] == "NP") echo 'selected'; echo' >NP</option>
    <option value="PP"'; if($_REQUEST['selected'] == "PP") echo 'selected'; echo' >PP</option>
    <option value="P"'; if($_REQUEST['selected'] == "P") echo 'selected'; echo' >P</option>
    <option value="Z"'; if($_REQUEST['selected'] == "Z") echo 'selected'; echo' >Z</option>
    <option value="WP"'; if($_REQUEST['selected'] == "WP") echo 'selected'; echo' >WP</option>
    <option value="W"'; if($_REQUEST['selected'] == "W") echo 'selected'; echo' >W</option>';
    ?>