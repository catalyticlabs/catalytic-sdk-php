<?php

namespace Catalytic\SDK\Search;

use DateTime;

/**
 * Class used to build queries for searching for Users
 */
class UsersWhere
{
    /**
     * Search by multiple criteria
     *
     * @param UserSearchClause[] $and   Search criteria to search for Users by
     * @return UserSearchClause         The search clause
     */
    public static function and(UserSearchClause ...$and): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setAnd($and);
        return $userSearchClause;
    }

    /**
     * Search by multiple criteria
     *
     * @param UserSearchClause[] $or    Search criteria to search for Users by
     * @return UserSearchClause         The search clause
     */
    public static function or(UserSearchClause ...$or): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setOr($or);
        return $userSearchClause;
    }

    /**
     * Search by id
     *
     * @param string $id        The id to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function id(string $id): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setId($id);
        return $userSearchClause;
    }

    /**
     * Search by email
     *
     * @param string $email     The email to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function email(string $email): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setEmail($email);
        return $userSearchClause;
    }

    /**
     * Search by partial email
     *
     * @param string $email     The partial email to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function emailContains(string $email): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setEmailContains($email);
        return $userSearchClause;
    }

    /**
     * Search by a range of emails
     *
     * @param string $start     The inclusive start email to search for Users by
     * @param string $end       The inclusive start email to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function emailBetween(String $start, String $end): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setEmailBetween($start, $end);
        return $userSearchClause;
    }

    /**
     * Search by full name
     *
     * @param string $fullName  The full name to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function fullName(string $fullName): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setFullName($fullName);
        return $userSearchClause;
    }

    /**
     * Search by partial full name
     *
     * @param string $fullName  The partial full name to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function fullNameContains(string $fullName): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setFullNameContains($fullName);
        return $userSearchClause;
    }

    /**
     * Search by a range of full name's
     *
     * @param string $start     The inclusive start full name to search for Users by
     * @param string $end       The inclusive start full name to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function fullNameBetween(String $start, String $end): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setFullNameBetween($start, $end);
        return $userSearchClause;
    }

    /**
     * Search by team admin
     *
     * @param string $isTeamAdmin   The team admin to search for Users by
     * @return UserSearchClause     The search clause
     */
    public static function isTeamAdmin(bool $isTeamAdmin): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setIsTeamAdmin($isTeamAdmin);
        return $userSearchClause;
    }

    /**
     * Search by deactivated
     *
     * @param string $isDeactivated The deactivated to search for Users by
     * @return UserSearchClause     The search clause
     */
    public static function isDeactivated(bool $isDeactivated): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setIsDeactivated($isDeactivated);
        return $userSearchClause;
    }

    /**
     * Search by locked out
     *
     * @param string $isLockedOut   The locked out to search for Users by
     * @return UserSearchClause     The search clause
     */
    public static function isLockedOut(bool $isLockedOut): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setIsLockedOut($isLockedOut);
        return $userSearchClause;
    }

    /**
     * Search by created date
     *
     * @param string $createdDate   The locked out to search for Users by
     * @return UserSearchClause     The search clause
     */
    public static function createdDate(DateTime $createdDate): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setCreatedDate($createdDate);
        return $userSearchClause;
    }

    /**
     * Search by a range of created dates
     *
     * @param string $start     The inclusive start date to search for Users by
     * @param string $end       The inclusive start date to search for Users by
     * @return UserSearchClause The search clause
     */
    public static function createdDateBetween(DateTime $start, DateTime $end): UserSearchClause
    {
        $userSearchClause = new UserSearchClause();
        $userSearchClause->setCreatedDateBetween($start, $end);
        return $userSearchClause;
    }
}