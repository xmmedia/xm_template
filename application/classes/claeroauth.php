<?php defined('SYSPATH') or die('No direct script access.');

class claeroauth extends Claerolib4_Auth {


    /**
    *   Sets users session, overriden from the default class in the claero module, go ahead and put whatever you want in here!
    *
    *   @param      int     $userId     the id of the user we are setting the session for
    */
    protected function SetSession($userId) {

        $status = false;

        $userSql = "SELECT `" . $this->claeroDb->EscapeString($this->usernameColumn) . "`, `" . $this->claeroDb->EscapeString($this->firstnameColumn) . "`, `" . $this->claeroDb->EscapeString($this->lastnameColumn) . "`
            FROM `" . $this->claeroDb->EscapeString($this->tableName) . "`
            WHERE `" . $this->claeroDb->EscapeString($this->idColumn) . "` = '" . $this->claeroDb->EscapeString($userId) . "'
            LIMIT 1";
        $userQuery = $this->claeroDb->Query($userSql);
        if ($userQuery === false) {
            trigger_error('Query Error: Failed to retrieve user\'s name: ' . $userSql, E_USER_ERROR);
        } else if ($userQuery->NumRows() == 0) {
            trigger_error('Query Error: Failed to find user in users table: ' . $userSql, E_USER_WARNING);
        } else {
            $status = true;

            $userQuery->FetchInto($userData);
            $_SESSION['username'] = $userData[$this->usernameColumn];
            $_SESSION['first_name'] = $userData[$this->firstnameColumn];
            $_SESSION['last_name'] = $userData[$this->lastnameColumn];
            $_SESSION['full_name'] = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];

            $countSql = "UPDATE `" . $this->claeroDb->EscapeString($this->tableName) . "` SET login_count = login_count + 1 WHERE `" . $this->claeroDb->EscapeString($this->idColumn) . "` = '" . $this->claeroDb->EscapeString($userId) . "' LIMIT 1";
            $countQuery = $this->claeroDb->Query($countSql);
            if ($countQuery === false || $countQuery === 0) {
                trigger_error('Query Error: Failed to update the user\'s login count: ' . $countSql, E_USER_ERROR);
                $this->error[] = 'Failed to update the user\'s login count.';
            }
        }

        return $status;

    } // function SetSession

}