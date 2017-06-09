<?php include "template/header.php"; ?>

<style rel="stylesheet" type="text/css">
	table, th, td, tr{
		border-collapse:collapse;
		border:1px solid #999;
	}
	thead th{
		background: rgb(206,220,231); /* Old browsers */
		background: -moz-linear-gradient(top,  rgba(206,220,231,1) 0%, rgba(89,106,114,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(206,220,231,1)), color-stop(100%,rgba(89,106,114,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* IE10+ */
		background: linear-gradient(to bottom,  rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedce7', endColorstr='#596a72',GradientType=0 ); /* IE6-9 */
	}
	thead tr {
		padding:10px;
		color:#333;
		text-shadow:1px 1px 0px #CCC;
		font-size:15px;
		background-color : #e0e0e0;
	}
	thead tr,td,th {
		background-color : #f7f7f7;
	}
</style>
<div class="container">
	<div id="manage-member">
		<table border="1">
			<thead>
				<tr>
					<th width="100px">Username</th>
					<th width="100px">Fullname</th>
				</tr>
			</thead>
			
			<tbody>
				<?php foreach ($members as $member): ?>
					<?php if ($member['role'] !== "1"): ?>
						<tr>
							<td width="100px"><?php echo $member['username']; ?></td>
							<td width="1000px"><a href="<?php echo base_url()."Pages/profile/".$member['username']; ?>"><?php echo $member['fullname']; ?></a></td>
							<td width="75px"><a href="<?php echo base_url(); ?>Admin/delete/<?php echo $member['username']; ?>">Delete</a></td>
						</tr>
					<?php endif; ?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
<?php include "template/footer.php"; ?>