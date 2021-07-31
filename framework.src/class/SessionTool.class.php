<?php

namespace webapp_php_sample_class;

use Exception;

class SessionTool
{

	/**
	 * @param $db
	 */
	public static function LoginUser($db): void
    {
        $myUsername = Main::checkRequest('post', 'username');
        $myPassword = Main::checkRequest('post', 'password');
        $queryCheck = "SELECT userName, usr.UID, passwort FROM usr LEFT JOIN passWd ON usr.UID = passWd.UID WHERE userName = '" . filter_var($myUsername, FILTER_SANITIZE_STRING) . "';";
        if ($result = $db->query($queryCheck, MYSQLI_USE_RESULT)) {
            while ($rArray = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $trust = password_verify($myPassword, $rArray['passwort']);
                if ($trust === true) {
                    $_SESSION['login_User'] = $myUsername;
                    $_SESSION['UID'] = $rArray['UID'];
                    header('Location: Home');
                    exit;
                }

                $error = 'Your Login Name or Password is invalid';
                ErrorHandler::FireWarning('Login failed', $error);
            }
        }
        mysqli_close($db);
    }

	/**
	 *
	 */
	public static function UserWelcome(): void
    {
        if (isset($_SESSION['login_User'])) {
            $username = $_SESSION['login_User'];
            echo '<form method= "post"  id= "userLogin">';
            echo '<div class="dropdown">';
            echo '<button class="btn btn-secondary dropdown-toggle nav-link button btn-danger" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">User menu</button>';
            echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
            echo "<label id= \"greetings\" class='greeting dropdown-item'>Welcome, $username </label>" . '   ';
            echo '<div class="dropdown-divider"></div>';
            echo '<li class="nav-item"><a class="dropdown-item" href="/Settings"> Settings</a></li>';
            echo '<button id= "logout" type="submit" class="btn btn-danger button logging-btn dropdown-item" name= "logout" value= "TRUE">Logout</button>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
        } else {
            echo "<a href=\"/Login\" class='logging-btn-a nav-link'><button class=\"logging-btn\">Login/Registration</button></a>";
        }
        $logoutCheck = Main::checkRequest('post', 'logout');
        if ($logoutCheck === 'TRUE') {
            session_destroy();
            header('Location: Home');
            exit;
        }
    }

	/**
	 * @param $db_link
	 * @throws Exception
	 */
	public static function AddUser($db_link): void
    {
        $username = filter_var(Main::checkRequest('post', 'username'), FILTER_SANITIZE_STRING);
        $firstName = filter_var(Main::checkRequest('post', 'firstName'), FILTER_SANITIZE_STRING);
        $secondName = filter_var(Main::checkRequest('post', 'lastName'), FILTER_SANITIZE_STRING);
        $email = filter_var(Main::checkRequest('post', 'email'), FILTER_SANITIZE_EMAIL);
        $age = Main::checkRequest('post', 'age');
        $password = filter_var(Main::checkRequest('post', 'pw'), FILTER_SANITIZE_STRING);
        $pwSave = password_hash($password, PASSWORD_DEFAULT);
		$USERID = Helper::GUID();
		$PASSWORD_WID = Helper::GUID();

        $age = implode('-', array_reverse(explode('.', $age)));

        $queryUSID = "SELECT MAX(UID) AS 'ID' FROM usr;";

        if ($result = mysqli_query($db_link, $queryUSID)) {

            while ($obj = mysqli_fetch_array($result)) {

                $query = "INSERT INTO usr ( UID, userName, firstName, lastName, email, userRank, age ) VALUES ( '$USERID', '$username' , '$firstName', '$secondName', '$email', 'User', '$age' );";

                $query2 = "INSERT INTO passWd ( PWID, passwort, UID) VALUES ( '$PASSWORD_WID', '$pwSave', '$USERID');";

                $db_link->query($query);
                $db_link->query($query2);

            }
        }
        mysqli_close($db_link);
    }
}
