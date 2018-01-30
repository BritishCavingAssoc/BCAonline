<?php
App::uses('Component', 'Controller');

class UserUtilitiesComponent extends Component {

/**
 * David G Cooke 11/10/2012
 * See http://bakery.cakephp.org/articles/deldan/2010/09/22/password-generator
 */
	function generatePassword ($length = 8){

		//$chars = "2345678923456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ_!@#$%&*()[]-=+/_!@#$%&*()[]-=+/";
		$chars = "2345678923456789abcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
		$i = 0;
		$password = "";

		while ($i < $length) {
			$password .= $chars[mt_rand(0, strlen($chars)-1)];
			$i++;
		}
		return $password;
	}

/**
 * Creates a user name from the short name and membership number.
 * Username is the first 4 letters of the surname plus the membership number.
 * Returns an empty string on failing.
 */
	function generateUserName ($name, $number){

		$strMember = (string)$number;

		// Fail if missing or bad parameters.
		if ($name == null || $number == null || $number == 0 || $strMember == '') return '';

		// Extract only letters
		for ($username = '', $len = strlen($name), $i = 0; $i < $len; $i++) {

			$char = $name{$i};

			if (($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z')) {
				$username .= $char;
			}
		}

		// Take up to the first 4 character.
		$username = strtoupper(substr($username, 0, 4));

		// Fail if username empty.
		if ($username == '' || $username == FALSE) return '';

		$username .= $strMember;

		return $username;
	}

    /**
     * Checks if current user has at least one of the Roles
     * @param mixed $allowed_roles A role string or an array of roles.
     * Returns true or false.
     */

    function hasRole ($allowed_roles){

        // If string convert to array.
        if (!is_array($allowed_roles)) $allowed_roles = array($allowed_roles);

        //Add admin role. Admin always succeeds.
        $allowed_roles[] = 'Admin';

        //Get user roles.
        $user_roles = explode(',', AuthComponent::user('roles'));
        $user_roles = array_map('trim', $user_roles);

        //Convert to upper case for comparison.
        $allowed_roles = array_map('strtoupper', $allowed_roles);
        $user_roles = array_map('strtoupper', $user_roles);

        $matches = array_intersect($user_roles, $allowed_roles);
        
        //return true user has at least one role.
        return !empty($matches);
    }
}
