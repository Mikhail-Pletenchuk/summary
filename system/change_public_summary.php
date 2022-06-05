<?php
// debug($_GET);
if (!empty($_GET)) {
	if (isset($_GET['delete_public'])) {
		// echo "delete_public=" . (int)$_GET['delete_public'];
		//!должен менять публикацию только для своих резюме
		if ((int)$_GET['delete_public'] && isset($_SESSION['email'])) {
			$user = getUsers($_SESSION['email']);
			$summary = getSummary((int)$_GET['delete_public']);
			if ($user[0]['ID'] == $summary[0]['users_id']) {
				$summary_value['public'] = 0;
				updateSummary($summary_value, (int)$_GET['delete_public']);
			}
		}
		unset($_GET['delete_public']);
	}

	if (isset($_GET['set_public'])) {
		// echo "set_public=" . (int)$_GET['set_public'];
		if ((int)$_GET['set_public'] && isset($_SESSION['email'])) {
			$user = getUsers($_SESSION['email']);
			$summary = getSummary((int)$_GET['set_public']);
			if ($user[0]['ID'] == $summary[0]['users_id']) {
				$summary_value['public'] = 1;
				updateSummary($summary_value, (int)$_GET['set_public']);
			}
		}
		unset($_GET['set_public']);
	}
	// debug($_GET);
}
