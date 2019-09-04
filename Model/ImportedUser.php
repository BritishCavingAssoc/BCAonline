<?php
App::uses('AppModel', 'Model');

class ImportedUser extends AppModel
{
    public $name = 'ImportedUser';
    public $displayField = 'id';
    public $actsAs = array('Csv.Csv' => array('length' => '1000','delimiter' => "\t"));

    public $virtualFields = array(
        'full_name' => 'TRIM(CONCAT(IFNULL(ImportedUser.forename,""), " ", IFNULL(ImportedUser.surname,"")))'
    );

    public $validate = array(
        'class' => array(
            'rule' => array('inList', array('CIM','DIM','GRP')),
            'required' => 'create',
            'allowEmpty' => false,
            'message' => 'Class must be CIM, DIM or GRP.'
        ),
        'forename' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Forename can not be longer than 25 characters.'
            ),
        'surname' => array(
            'rule' => array('maxlength', 30),
            'allowEmpty' => true,
            'message' => 'Surname can not be longer than 30 characters.'
        ),
        'bca_no' => array(
            'rule' => 'numeric',
            'required' => 'create',
            'allowEmpty' => false,
            'message' => 'BCA No. must be a number.'
        ),
        'organisation' => array(
            'rule' => array('maxlength', 50),
            'allowEmpty' => false,
            'message' => 'Organisation can not be missing or longer than 50 characters.'
        ),
        'position' => array(
            'rule' => array('maxlength', 50),
            'allowEmpty' => true,
            'message' => 'Position can not be longer than 50 characters.'
        ),
        'bca_status' => array(
            'rule' => array('inList', array('Current', 'Overdue', 'Lapsed', 'Resigned', 'Expelled', 'Deceased')),
            'required' => false,
            'allowEmpty' => true,
            'message' => 'BCA Status must be Current, Overdue, Lapsed, Resigned, Expelled, Deceased or blank.'
        ),
        'insurance_status' => array(
            'rule_valid_insurance_status' => array('rule' => 'ruleValidInsuranceStatus'),
        ),
        'class_code' => array(
            'rule' => array('maxlength', 10),
            'allowEmpty' => false,
            'message' => 'Class Code can not be missing or longer than 10 characters.'
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
        'date_of_expiry' => array(
            'rule' => array('date'),
            'message' => 'Invalid date.'
        ),
        'address1' => array(
            'rule' => array('maxlength', 60),
            'allowEmpty' => true,
            'message' => 'Address line 1 can not be longer than 60 characters.'
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
            'rule' => array('maxlength', 20),
            'allowEmpty' => true,
            'message' => 'Telephone can not be longer than 20 characters.'
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
            'allowEmpty' => true,
            'message' => 'Gender must be M, F, T or blank.'
        ),
        'year_of_birth' => array(
            'rule' => array('range', 1899, 2021),
            'allowEmpty' => true,
            'message' => 'Year of Birth must be after 1900 and not in the future.'
        ),
        'address_ok' => array(
            'rule' => array('maxlength', 25),
            'allowEmpty' => true,
            'message' => 'Address OK can not be longer than 25 characters.'
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
        'bcra_member' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'BCRA Member? must be yes, no or blank.'
        ),
        'ccc_member' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'CCC Member? must be yes, no or blank.'
        ),
        'cscc_member' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'CSCC Member? must be yes, no or blank.'
        ),
        'cncc_member' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'CNCC Member? must be yes, no or blank.'
        ),
        'dca_member' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'DCA Member? must be yes, no or blank.'
        ),
        'dcuc_member' => array(
            'rule' => 'boolean',
            'allowEmpty' => true,
            'message' => 'DCUC Member? must be yes, no or blank.'
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
        )
    );

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
                !in_array($this->data[$this->alias]['insurance_status2'], array('C','NC','STU','U18','AN', '')))
            {
                return 'Insurance Status 2 for individual members must be either C, NC, STU, U18, AN or blank.';
            }
        }

        return true;
    }
}
