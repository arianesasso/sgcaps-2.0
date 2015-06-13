<?php

class CommonFunctions {

    public static function hasRole($userRoles, $role, $domain) {
        return (array_search($role, $userRoles) === $domain ? true : false);
    }

}
