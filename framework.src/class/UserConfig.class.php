<?php


namespace webapp_php_sample_class;


class UserConfig
{
	/**
	 *
	 */
	public static function loadConfigTable(): void
    {
        self::tableGenerator();
        echo '<script>console.log("Config Page loaded")</script>';
    }

	/**
	 *
	 */
	private static function tableGenerator(): void
    {
        $userData = self::getUserData($_SESSION['login_User']);

        echo "<form class='form-session' method='post' target='_self'>";

        foreach ($userData as $item) {
            foreach ($item as $key => $value) {
                if ($key !== 'passwort') {
                    self::tableModule($key, $value);
                }
            }
        }
        echo '<input type="text" name="requestMode" value="userData" hidden />';
        echo "<button type='submit' class='btn btn-success'>Save</button>";
        echo ' | ';
        echo "<button type='reset' class='btn btn-danger'>Reset</button>";
        echo '</form>';

        echo "<form class='form-session' method='post' target='_self'>";

        foreach ($userData as $item) {
            foreach ($item as $key => $value) {
                if ($key === 'passwort') {
                    self::tableModule($key, $value);
                }
            }
        }

        echo '<input type="text" name="requestMode" value="password" hidden />';
        echo "<button type='submit' class='btn btn-success'>Save</button>";
        echo ' | ';
        echo "<button type='reset' class='btn btn-danger'>Reset</button>";
        echo '</form>';
    }

	/**
	 * @param $userName
	 * @return array
	 */
	private static function getUserData($userName): array
    {
        $userDataArray = [];
        $userData = DatabaseHandler::createSqlRequest(
            'select',
            'usr',
            '*',
            null,
            " usr.userName = '" . $userName . "'");
        $userPassword = DatabaseHandler::createSqlRequest(
            'select',
            'passWd',
            '*',
            null,
            "UID = '" . $userData[0]['UID'] . "'");

        foreach ($userData as $item) {
            foreach ($item as $key => $val) {
                if ($key === 'userName'
                    || $key === 'firstName'
                    || $key === 'lastName'
                    || $key === 'email') {
                    $userDataArray[] = [$key => $val];
                }
            }
        }

        foreach ($userPassword as $item) {
            foreach ($item as $key => $val) {
                if ($key === 'passwort') {
                    $userDataArray[] = [$key => $val];
                }
            }
        }
        return $userDataArray;
    }

	/**
	 * @param $key
	 * @param $value
	 */
	private static function tableModule($key, $value): void
    {

        switch ($key) {
            case 'userName':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-user-tie"></i> Username </label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'firstName':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '">First name</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'lastName':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '">Surname</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'email':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="far fa-envelope"></i> E-Mail</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

            case 'passwort':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-key"></i> Old password *</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="old' . $key . 'Input"
               name="old_' . $key . '"
               placeholder="Enter ' . $key . '"
               type="password"
               required type="text">';
                echo '<small id="old_password" class="form-text text-muted">* The old one is required to create a new password!</small>';
                echo '</div>';
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-key"></i> New Password</label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               type="password"
               required type="text">';
                echo '</div>';
                break;

            case 'age':
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-user-tie"></i> ' . $key . ' </label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
                    name="' . $key . '"
                    placeholder="Enter ' . $key . '"
                    value="' . $value . '"
                    required type="date">';
                echo '</div>';
                break;

            default:
                echo '<div class="form-group">';
                echo '<label class="label" for="Input' . $key . '"><i class="fas fa-user-tie"></i> ' . $key . ' </label>';
                echo '<input aria-describedby="' . $key . 'Input" class="form-control input" id="' . $key . 'Input"
               name="' . $key . '"
               placeholder="Enter ' . $key . '"
               value="' . $value . '"
               required type="text">';
                echo '</div>';
                break;

        }
    }

	/**
	 *
	 */
	public static function userDataRequest(): void
    {
        $requestMode = Main::checkRequest('post', 'requestMode');
        $username = Main::checkRequest('post', 'userName');
        $firstName = Main::checkRequest('post', 'firstName');
        $lastName = Main::checkRequest('post', 'lastName');
        $email = Main::checkRequest('post', 'email');
        $requestMode = Main::checkRequest('post', 'requestMode');
        $old_passwort = Main::checkRequest('post', 'old_passwort');
        $passwort = Main::checkRequest('post', 'passwort');

        switch ($requestMode) {
            case 'userData':
                if ($username !== null && $firstName !== null && $lastName !== null && $email !== null) {
                    DatabaseHandler::createSqlRequest('update', 'usr', null, [
                        'userName' => $username,
                        'firstName' => $firstName,
                        'lastName' => $lastName,
                        'email' => $email
                    ], 'UID = "' . $_SESSION['UID'] . '"');
                    $_SESSION['login_User'] = $username;
                    return;
                }
                ErrorHandler::FireWarning('Invalid Input', 'all input fields are required');
                break;

            case 'password':
                if ($old_passwort !== null && $passwort !== null && $result = DatabaseHandler::createSqlRequest(
                        'select',
                        'passWd',
                        '*',
                        null,
                        "UID = '" . $_SESSION['UID'] . "'")) {

                    $trust = password_verify($old_passwort, $result[0]['passwort']);
                    if ($trust) {
                        $pwHash = password_hash($passwort, PASSWORD_DEFAULT);
                        if (DatabaseHandler::createSqlRequest(
                            'update',
                            'passWd',
                            null,
                            ['passwort' => $pwHash],
                            'passWd.UID = "' . $_SESSION['UID'] . '"'
                        )) {
                            //ErrorHandler::FireSuccess('', 'Request done!');
                            break;
                        }
                    }
                }

                $error = 'Your Password is invalid';
                ErrorHandler::FireError('Password', $error);
                break;
        }
    }
}
