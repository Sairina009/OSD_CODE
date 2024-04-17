<?php require_once 'auditheader.php'; 
$sql=$kvmdata->audit();
while ($row=mysqli_fetch_array($sql)) {
    $username=$row['username']; ?>
<tr>
    <td><?php echo date("M d, Y H:i", strtotime($row['date_created'])) ?></td>
    <td><?php echo $row['event']; ?></td>
    <td><?php echo 'User&nbsp;'.$username , '&nbsp;'.$row['action_made'] ?></td>
</tr>
<?php } ?>
</table>
</div>
<?php require_once 'auditfooter.php'; ?>
</div>
</body>

</html>