<?php
// debug($_GET);
if (!empty($_GET)) {
	if (isset($_GET['delete_user'])) {
		// echo "delete_user=" . (int)$_GET['delete_user'];
		if ((int)$_GET['delete_user'] && $_SESSION['access'] == 3) {
			$user = getUsers((int)$_GET['delete_user']);
			if ($user && $user[0]['access'] < 3) {
				deleteUser((int)$_GET['delete_user']);
			}
		}
		unset($_GET['delete_user']);
		// debug($_GET);
	}
}
