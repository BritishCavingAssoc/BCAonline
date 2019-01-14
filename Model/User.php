<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{
    public $name = 'User';
    public $hasOne = 'LastLogin';
    public $hasMany = array('SentEmail', 'Token');
    public $actsAs = array('Containable');

    public $virtualFields = array(
        'full_name' => 'TRIM(CONCAT(IFNULL(User.forename,""), " ", IFNULL(User.surname,"")))'
    );

    public function beforeSave($options = array()) {

        parent::beforeSave($options);

        // Always assign 'password' incase 'passwd' has changed.
        if (!empty($this->data[$this->alias]['passwd_new'])) {
            $PasswordHasher = new SimplePasswordHasher();
            $this->data[$this->alias]['password'] = $PasswordHasher->hash($this->data[$this->alias]['passwd_new']);
        }

        unset($this->data[$this->alias]['passwd_new']);
        unset($this->data[$this->alias]['passwd_confirm']);

        return true;
    }

    public $validate = array(
        'username' => array(
            'rule' => array('maxlength', 20),
            'allowEmpty' => false,
            'message' => 'Username is required and can not be longer than 20 characters.'
        ),
        'email' => array(
            'email' => array(
                'rule' => 'email',
                'required' => false,
                'allowEmpty' => true,
                'message' => 'Invalid Email address'
                ),
            'maxlength' => array(
                'rule' => array('maxlength', 50),
                'message' => 'Email can not be longer than 50 characters.'
            )
        ),
        'forename' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Forename can not be longer than 25 characters.'
        ),
        'surname' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Surname can not be longer than 25 characters.'
        ),
        'organisation' => array(
            'rule' => array('maxlength', 50),
            'allowEmpty' => false,
            'message' => 'Organisation can not be missing or longer than 50 characters.'
        ),
        'short_name' => array(
            'rule' => array('maxlength', 20),
            'allowEmpty' => true,
            'message' => 'Short Name can not be longer than 20 characters.'
        ),
        'position' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Position can not be longer than 25 characters.'
        ),
        'bca_status' => array(
            'rule' => array('inList', array('Current', 'Overdue', 'Lapsed', 'Resigned', 'Expelled', 'Deceased')),
            'allowEmpty' => true,
            'message' => 'BCA Status must be Current, Overdue, Lapsed, Resigned, Expelled, Deceased or blank.'
        ),
        'bca_no' => array(
            'rule' => 'numeric',
            'required' => 'create',
            'allowEmpty' => false,
            'message' => 'BCA No. must be a number.'
        ),
        'class' => array(
            'rule' => array('inList', array('CIM','DIM','GRP')),
            'required' => 'create',
            'allowEmpty' => false,
            'message' => 'Class must be CIM, DIM or GRP.'
        ),
        'class_code' => array(
            'rule' => array('maxlength', 10),
            'allowEmpty' => false,
            'message' => 'Class Code can not be missing or longer than 10 characters.'
        ),
        'insurance_status' => array(
            'rule_valid_insurance_status' => array('rule' => 'ruleValidInsuranceStatus'),
        ),
        'date_of_expiry' => array(
            'rule' => array('date'),
            'allowEmpty' => true,
            'message' => 'Invalid date.'
        ),
        'address1' => array(
            'rule' => array('maxlength', 40),
            'allowEmpty' => true,
            'message' => 'Address line 1 can not be longer than 40 characters.'
        ),
        'address2' => array(
            'rule' => array('maxlength', 40),
            'allowEmpty' => true,
            'message' => 'Address line 2 can not be longer than 40 characters.'
        ),
        'address3' => array(
            'rule' => array('maxlength', 40),
            'allowEmpty' => true,
            'message' => 'Address line 3 can not be longer than 40 characters.'
        ),
        'town' => array(
            'rule' => array('maxlength', 40),
            'allowEmpty' => true,
            'message' => 'Town can not be longer than 40 characters.'
        ),
        'county' => array(
            'rule' => array('maxlength', 40),
            'allowEmpty' => true,
            'message' => 'County can not be longer than 40 characters.'
        ),
        'postcode' => array(
            'rule' => array('maxlength', '10'),
            'allowEmpty' => true,
            'message' => 'Post Code can not be longer than 10 characters.'
        ),
        'country' => array(
            'rule' => array('maxlength', 30),
            'allowEmpty' => true,
            'message' => 'Country can not be longer than 30 characters.'
        ),
        'telephone' => array(
            'rule' => array('maxlength', 50),
            'allowEmpty' => true,
            'message' => 'Telephone can not be longer than 50 characters.'
        ),
        'website' => array(
            'website' => array(
                'rule' => 'url',
                'required' => false,
                'allowEmpty' => true,
                'message' => 'Invalid website address'
                ),
            'maxlength' => array(
                'rule' => array('maxlength', 100),
                'message' => 'Website can not be longer than 100 characters.'
            )
        ),
        'gender' => array(
            'rule' => array('inList', array('M','F','T','')),
            'required' => 'create',
            'allowEmpty' => true,
            'message' => 'Gender must be M, F, T or blank.'
        ),
        'year_of_birth' => array(
            'rule' => array('range', 1900, 2020),
            'allowEmpty' => true,
            'message' => 'Year of Birth must be after 1900.'
        ),
        'address_ok' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Address OK can not be longer than 25 characters.'
        ),
        'allow_club_updates' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'Allow Club Updates? must be yes, no or blank.'
        ),
        'admin_email_ok' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'Admin Email OK? must be yes, no or blank.'
        ),
        'bca_email_ok' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'BCA Email OK? must be yes, no or blank.'
        ),
        'bcra_email_ok' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'BCRA Email OK? must be yes, no or blank.'
        ),
        'forename2' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Forename 2 can not be longer than 25 characters.'
        ),
        'surname2' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Surname 2 can not be longer than 25 characters.'
        ),
        'bca_no2' => array(
            'rule' => 'numeric',
            'allowEmpty' => true,
            'message' => 'BCA No. 2 must be a number or blank.'
        ),
        'insurance_status2' => array(
            'rule_valid_insurance_status' => array('rule' => 'ruleValidInsuranceStatus'),
        ),
        'class_code2' => array(
            'rule' => array('maxlength', 10),
            'allowEmpty' => true,
            'message' => 'Class Code 2 can not be longer than 10 characters.'
        ),
        'roles' => array(
            'rule' => array('maxlength', 250),
            'allowEmpty' => true,
            'message' => 'The list of roles can not be longer than 250 characters.'
        ),
        //Fields used on forms but not in the database.
        'passwd_old' => array(
            'rule_max_length' => array(
                'rule' => array('maxlength', 30),
                'message' => 'Your password is too long.'
            ),
            'rule_is_current_password' => array('rule' => 'ruleIsCurrentPassword'),
        ),
        'passwd_new' => array(
            'rule_not_empty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is needed.'
            ),
            'rule_max_length' => array(
                'rule' => array('maxlength', 30),
                'message' => 'Your password is too long.'
            ),
            'rule_min_length' => array(
                'rule' => array('minlength', 6),
                'message' => 'Your password should be at least 6 characters long.'
            ),
            'rule_is_different_password' => array('rule' => 'ruleIsDifferentPassword'),
        ),
        'passwd_confirm' => array(
            'rule_not_empty' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is needed.'
            ),
            'rule_max_length' => array(
                'rule' => array('maxlength', 30),
                'message' => 'Your password is too long.'
            ),
            'rule_min_length' => array(
                'rule' => array('minlength', 6),
                'message' => 'Your password should be at least 6 characters long.'
            ),
            'rule_new_passwords_match' => array('rule' => 'ruleNewPasswordsMatch'),
        ),
        'email_confirm' => array(
            'email' => array(
                'rule' => 'email',
                'required' => false,
                'allowEmpty' => true,
                'message' => 'Invalid Email address'
                ),
            'maxlength' => array(
                'rule' => array('maxlength', 50),
                'message' => 'Email can not be longer than 50 characters.'
            )
        ),
    );

    public function ruleIsCurrentPassword($data) {

        $PasswordHasher = new SimplePasswordHasher();

        if ($this->field('password') !== $PasswordHasher->hash($this->data[$this->alias]['passwd_old'])) {
            return 'This is not your old password.';
        }

        return true;
    }

    public function ruleIsDifferentPassword($data) {

        if (isset($this->data[$this->alias]['passwd_old']) && $this->data[$this->alias]['passwd_old'] === $this->data[$this->alias]['passwd_new']) {
            return 'You should pick a new password.';
        }

        return true;
    }

    public function ruleNewPasswordsMatch($data) {

        if ($this->data[$this->alias]['passwd_new'] !== $this->data[$this->alias]['passwd_confirm']) {
            return 'This does not match your new password.';
        }

        return true;
    }

    //Class is required but insurance_status(2) is not.
    public function ruleValidInsuranceStatus($data) {

    if (!isset($this->data[$this->alias]['class'])) return 'Class must be CIM, DIM or GRP.';

        //If GRP.
        if ($this->data[$this->alias]['class'] == 'GRP') {
            if (isset($this->data[$this->alias]['insurance_status']) &&
                !in_array($this->data[$this->alias]['insurance_status'], array('Y', 'N', '')))
            {
                return 'Insurance Status for group members must be either Y, N or blank.';
            }
            if (isset($this->data[$this->alias]['insurance_status2']) &&
                !in_array($this->data[$this->alias]['insurance_status2'], array('Y', 'N', '')))
            {
                return 'Insurance Status 2 for group members must be either Y, N or blank.';
            }
        }
        else { //CIM or DIM.
            if (isset($this->data[$this->alias]['insurance_status']) &&
                !in_array($this->data[$this->alias]['insurance_status'], array('C','NC','STU','U18','AN','')))
            {
                return 'Insurance Status for individual members must be either C, NC, STU, U18, AN or blank.';
            }
            if (isset($this->data[$this->alias]['insurance_status2']) &&
                !in_array($this->data[$this->alias]['insurance_status2'], array('C','NC','STU','U18','AN','')))
            {
                return 'Insurance Status 2 for individual members must be either C, NC, STU, U18, AN or blank.';
            }
        }

        return true;
    }

    /**
    * syncDuplicates method
    *
    * Make password, email & email preferences the same for all user records with the same bca_no and email
    * as the primary id user.
    * Send one notifying email to each unique email address.
    *
    * @param string $id Primary user with the up to date values.
    * @return void
    *
    */
    public function syncDuplicates($id, $passwd_new = null) {

        $this->id = $id;

        if (!$this->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Get the up to date primary user.
        if (!$primary_user = $this->find('first', array(
            'fields' => array('id', 'bca_no', 'username', 'full_name', 'active', 'email', 'admin_email_ok', 'bca_email_ok', 'bcra_email_ok'),
            'conditions' => array('User.id' => $id),
            'contain' => false))
        ) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Pick out the fields, given by the second array, to check against.
        $check_values = array_intersect_key($primary_user['User'], array('active' => null, 'email' => null,
            'admin_email_ok' => null, 'bca_email_ok' => null, 'bcra_email_ok' => null));

        //Find the other users with the same bca_no.
        if(!$users = $this->find('all', array(
            'fields' => array('id', 'bca_no', 'username', 'full_name', 'active', 'email', 'admin_email_ok', 'bca_email_ok', 'bcra_email_ok'),
            'conditions' => array('User.bca_no' => $primary_user['User']['bca_no']),
            'contain' => false))
        ) {
            throw new NotFoundException(__('Invalid user'));
        }

        //Update any records that differ.
        $i = 0;
        $previous_emails = array();
        $syncd_users = array();

        while (isset($users[$i]['User']['id'])) {

            //Skip the primary user. That user record is, by definition, up to date.
            if ($primary_user['User']['id'] === $users[$i]['User']['id']) {$i++; continue;};

            //Find any differences.
            $diff['User'] = array_diff_assoc($check_values, $users[$i]['User']);

            //Add in new password if present.
            if (!empty($passwd_new)) {
                $diff['User']['passwd_new'] = $passwd_new;
            }

            if (!empty($diff['User'])) {

                //Keep info for confirmation emails. NB only sent where the email address is different from the primary user's and
                //different from previous emails.
                if ($primary_user['User']['email'] != $users[$i]['User']['email'] &&
                    array_search($users[$i]['User']['email'], $previous_emails) === FALSE) {

                    $previous_emails[] = $users[$i]['User']['email'];

                    $syncd_users[] = array(
                        'id' => $users[$i]['User']['id'],
                        'bca_no' => $users[$i]['User']['bca_no'],
                        'email' => $users[$i]['User']['email'],
                        'full_name' => $users[$i]['User']['full_name'],
                    );
                }

                $this->clear(); //Make sure we only save the values held in $diff.
                $this->id = $users[$i]['User']['id'];

                if (!$this->save($diff)) {
                    //debug($this->validationErrors); die();
                    throw new InternalErrorException(__('Sync\'ing Duplicate Users failed'));
                }
            }
            $i++;
        }

        return $syncd_users;
    }

    /*
    * Returns user's email info including if it is OK to send the user emails, false otherwise.
    */
    public function EmailInfo($user_id = null) {

        if (empty($user_id)) {
            throw new InternalErrorException(__('No User Id supplied.'));
        }

        //Get the user.
        if (!$user = $this->find('first', array('conditions' => array('User.id' => $user_id), 'contain' => false))) {
            return false;
        }

        //Set isEmailable if is active and accepts BCA administration emails.
        $isEmailable = ($user['User']['active'] && $user['User']['admin_email_ok']);

        return array('email' => $user['User']['email'],
            'bca_no' => $user['User']['bca_no'],
            'isEmailable' => $isEmailable);
    }

    /*
    * Marks all the records with the same BCA as the same person.
    *
    * Returns true on success, false on failure.
    */

    public function MarkSamePerson($bca_no = null) {

        //if (empty($bca_no)) {throw new InternalErrorException(__('No BCA No. supplied.'))};

        // Make sure it is a number.
        //if (!is_numeric($bca_no)) {
        //    throw new InternalErrorException(__('Not a valid BCA No.'))};

        $fields = array('User.same_person' => true);

        //Don't bother to update records where same_person is already true - saves space in the audit table.
        $conditions = array('User.bca_no =' => $bca_no, 'User.same_person !=' => true);

        return $this->updateALL($fields, $conditions);
    }


    /*
    * Creates a new user name from bca_no.
    */
    public static function MakeUserName($bca_no) {

        // Set username. Pad to 5 characters with leading 0.
        if (!empty($bca_no)) {
            return str_pad($bca_no, 5, "0", STR_PAD_LEFT);
        } else {
            return null;
        }
    }
}
