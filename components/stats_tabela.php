<style>

table, th, td {
  border: 1px solid black;
  padding: 5px;

}
</style>
<?php include 'components/stats.php'; ?><br>
<? include 'slownik/zmienne.php'; ?>
<table>
<tbody>
<tr>
<td style="vertical-align: top;"><?php include 'components/stats_okres.php';?></td>
<td style="vertical-align: top;"> <?php include 'components/stats_typ.php'; ?></td>
<td style="vertical-align: top;"><?php include 'components/stats_uw.php'; ?></td>
<td style="vertical-align: top;"><?php include 'components/stats_gmina.php'; ?></td>
<td style="vertical-align: top;"> <?php include 'components/stats_kraj.php'; ?></td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
