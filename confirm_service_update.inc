<?php
function showMessage($msg) {

?>

<html>
	<body>
		<div id="wrapper">
			
				<div id="content">
					<form>
						<table>
							<tr>
								<td></td>
								<td><?php echo $msg; ?></td>
							</tr>

							<tr>
								<td></td>
								<td><input class="rounded" type="button" onclick="location.href = '../patient_account.php'"
									name="submit" id="backToPatientAccountBtn" value="Back to Patient's Account Form"></td>
							</tr>
						</table>
					</form>
				</div>
				
			<div id="sidebar">
			</div>
			
			<?php
			include("pagecomponents/footer.php");
			?>		
		</div>
	</body>
</html>
<?php
}
?>