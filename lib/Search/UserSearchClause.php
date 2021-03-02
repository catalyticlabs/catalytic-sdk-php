<?php

namespace Catalytic\SDK\Search;

use DateTime;

/**
 * Class used to create search criteria for searching Users
 */
class UserSearchClause
{
    private $and;
    private $or;
    private $id;
    private $email;
    private $fullName;
    private $isTeamAdmin;
    private $isDeactivated;
    private $isLockedOut;
    private $createdDate;

    public function getAnd(): ?array
    {
        return $this->and;
    }

    public function setAnd(array $and): void
    {
        $this->and = $and;
    }

    public function getOr(): ?array
    {
        return $this->or;
    }

    public function setOr(array $or): void
    {
        $this->or = $or;
    }

    public function getId(): ?GuidSearchExpression
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $idExpression = new GuidSearchExpression();
        $idExpression->setIsEqualTo($id);
        $this->id = $idExpression;
    }

    public function getEmail(): ?StringSearchExpression
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $emailExpression = new StringSearchExpression();
        $emailExpression->setIsEqualTo($email);
        $this->email = $emailExpression;
    }

    public function setEmailContains(string $emailContains): void
    {
        $emailExpression = new StringSearchExpression();
        $emailExpression->setContains($emailContains);
        $this->email = $emailExpression;
    }

    public function setEmailBetween(string $start, string $end)
    {
        $emailExpression = new StringSearchExpression();
        $between = new StringRange($start, $end);
        $emailExpression->setBetween($between);
        $this->email = $emailExpression;
    }

    public function getFullName(): ?StringSearchExpression
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): void
    {
        $fullNameExpression = new StringSearchExpression();
        $fullNameExpression->setIsEqualTo($fullName);
        $this->fullName = $fullNameExpression;
    }

    public function setFullNameContains(string $fullNameContains): void
    {
        $fullNameExpression = new StringSearchExpression();
        $fullNameExpression->setContains($fullNameContains);
        $this->fullName = $fullNameExpression;
    }

    public function setFullNameBetween(string $start, string $end)
    {
        $fullNameExpression = new StringSearchExpression();
        $between = new StringRange($start, $end);
        $fullNameExpression->setBetween($between);
        $this->fullName = $fullNameExpression;
    }

    public function getIsTeamAdmin(): ?BooleanSearchExpression
    {
        return $this->isTeamAdmin;
    }

    public function setIsTeamAdmin(bool $isTeamAdmin): void
    {
        $isTeamAdminExpression = new BooleanSearchExpression();
        $isTeamAdminExpression->setIsEqualTo($isTeamAdmin);
        $this->isTeamAdmin = $isTeamAdminExpression;
    }

    public function getIsDeactivated(): ?BooleanSearchExpression
    {
        return $this->isDeactivated;
    }

    public function setIsDeactivated(bool $isDeactivated): void
    {
        $isDeactivatedExpression = new BooleanSearchExpression();
        $isDeactivatedExpression->setIsEqualTo($isDeactivated);
        $this->isDeactivated = $isDeactivatedExpression;
    }

    public function getIsLockedOut(): ?BooleanSearchExpression
    {
        return $this->isLockedOut;
    }

    public function setIsLockedOut(bool $isLockedOut): void
    {
        $isLockedOutExpression = new BooleanSearchExpression();
        $isLockedOutExpression->setIsEqualTo($isLockedOut);
        $this->isLockedOut = $isLockedOutExpression;
    }

    public function getCreatedDate(): ?DateTimeSearchExpression
    {
        return $this->createdDate;
    }

    public function setCreatedDate(DateTime $createdDate): void
    {
        $createdDateExpression = new DateTimeSearchExpression();
        $createdDateExpression->setIsEqualTo($createdDate);
        $this->createdDateExpression = $createdDateExpression;
    }

    public function setCreatedDateBetween(DateTime $start, DateTime $end)
    {
        $createdDateExpression = new DateTimeSearchExpression();
        $between = new DateTimeRange($start, $end);
        $createdDateExpression->setBetween($between);
        $this->createdDate = $createdDateExpression;
    }
}