<tr id="<?php echo $templ_task_id ?>">
    <!-- <td><button id="delete">X</button></td> -->
    <td><?php echo htmlspecialchars($templ_task_name) ?></td>
    <td><button id="complete"  onclick=deleteRow(this)>Complete</button></td>
</tr>

