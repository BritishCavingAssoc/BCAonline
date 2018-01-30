<?php
App::uses('AppModel', 'Model');

class SentEmail extends AppModel
{
    public $name = 'SentEmail';
    public $displayField = 'id';
    public $belongsTo = 'User';

    /**
    * send method
    *
    * Sends an email and also saves a copy.
    *
    * Supply either 'user_id' or 'to' address or both.
    * If 'user_id' but no 'to' supplied then isEmailable is checked. Sending can be forced. User's profile email address is used (safest).
    * If 'to' but no 'user_id' supplied then sending MUST be forced.
    * If 'user_id' and 'to' supplied then isEmailable is check. Sending can be force. There is the possibility of sending to an unrelated email address. (Risky)
    *
    * Will lookup missing details if 'user_id' > 0 and complain if 'user_id' not present.
    * Will send email if 'to' address present and 'isEmailable or 'forceSend' is true.
    * If 'to' address can't be found then complain if 'forceSend' is true otherwise silently do nothing.
    *
    * @return mixed True or $data on success, false otherwise.
    */
    public function send($emailToGo) {

        if (!isset($emailToGo)) {
          throw new InternalErrorException(__('No email elements.'));
        }

        if(!$configEmailAddresses = Configure::read('EmailAddresses')) {
            throw new NotFoundException(__('Invalid Email configuration'));
        }

        $emailDefaults = array(
            'user_id' => 0,
            'bca_no' => 0,
            'to' => NULL,
            'from' => $configEmailAddresses['bca_online_admin'],
            'subject' => "",
            'email_format' => 'text',
            'layout' => 'bca',
            'template' => 'default',
            'forceSend' => false,
            'save' => true,
            'viewVars' => NULL,
        );

        $emailElements = array_merge($emailDefaults, $emailToGo);

        //If user_id supplied, get user's email info and fill in any missing info.
        if ($emailElements['user_id'] != 0) {
            if ($userEmailInfo = $this->User->EmailInfo($emailElements['user_id'])) {
                if (empty($emailElements['to'])) $emailElements['to'] = $userEmailInfo['email'];
                if (empty($emailElements['bca_no'])) $emailElements['bca_no'] = $userEmailInfo['bca_no'];
            } else {
                throw new InternalErrorException(__('No such user.'));
            }
        } else {
            $userEmailInfo = array('isEmailable' => false);
        }

        //If no address to send email to.
        if (empty($emailElements['to'])) {
            //Silently do nothing unless it was a forced send.
            if ($emailElements['forceSend']) {
                throw new InternalErrorException(__('No address to send email to.'));
            } else {
                return false;
            }
        }

        //Don't send email if user is not emailable and not forced to send.
        if (!$userEmailInfo['isEmailable'] and !$emailElements['forceSend']) {
            return false;
        }

        //Send the email.
        $email = new CakeEmail('default');

        $email->from($emailElements['from'])
            ->to($emailElements['to'])
            ->subject($emailElements['subject'])
            ->template($emailElements['template'], $emailElements['layout'])
            ->emailFormat($emailElements['email_format']);

        if (!empty($emailElements['viewVars'])) {
            $email->viewVars($emailElements['viewVars']);
        }

        $sent = $email->send(); //!!!Dev check return value.

        //Save a copy of the email.
        if ($emailElements['save']) {
            $sentEmail['SentEmail']['user_id'] = $emailElements['user_id'];
            $sentEmail['SentEmail']['bca_no'] = $emailElements['bca_no'];
            $sentEmail['SentEmail']['from'] = $emailElements['from'];
            $sentEmail['SentEmail']['to'] = $emailElements['to'];
            $sentEmail['SentEmail']['subject'] = $emailElements['subject'];
            $sentEmail['SentEmail']['layout'] = $emailElements['layout'];
            $sentEmail['SentEmail']['template'] = $emailElements['template'];
            $sentEmail['SentEmail']['view_variables'] = json_encode($emailElements['viewVars']);
            $sentEmail['SentEmail']['message'] = $sent['message'];

            $this->create();
            return $this->save($sentEmail); //!!!Dev check return value.
        } else {
            return true;
        }
    }


}
