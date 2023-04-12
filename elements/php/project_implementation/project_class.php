<?php
class Project
{
    protected int $projectID = 0;
    protected string $title = "";
    protected DateTime $start;
    protected DateTime $end;
    protected string $phase = "";
    protected string $desc = "";
    protected int $userID = 1;
    protected string $username = "";
    protected string $userEmail = "";
    //we construct the project
    public function __construct($pid, $title, $startD, $endD, $phase, $description, $uid, $username, $email)
    {
        $this->projectID = $pid;
        $this->title = $title;
        $this->start = new DateTime($startD);
        $this->end = new DateTime($endD);
        $this->phase = $phase;
        $this->desc = $description;
        $this->userID = $uid;
        $this->username =$username;
        $this->userEmail = $email;
    }

    public function getPID()
    {
        return $this->projectID;
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function getStartDate()
    {
        //we format the date so we intantly get it as string
        return $this->start->format('Y-m-d');
    }
    public function getEndDate()
    {
        //we format the date so we intantly get it as string
        return $this->end->format('Y-m-d');
    }
    //duration between days
    public function getDuration()
    {
        $interval = (new DateTime($this->getStartDate()))->diff(new DateTime($this->getEndDate()));
        $hours = ($interval->days * 24) + $interval->h;
        $result = ($hours / 24) . " days";
        return $result;
    }
    public function getPhase()
    {
        return $this->phase;
    }
    public function getDesc()
    {
        return $this->desc;
    }
    public function getUID()
    {
        return $this->userID;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function getUserEmail()
    {
        return $this->userEmail;
    }
    //for testing purposes
    public function __toString()
    {
        $string = "Pid: " . $this->getPID() . ". Title: " . $this->getTitle() . ". Description: " . $this->getDesc() . ". Phase: " . $this->getPhase() . ". Start Date: " . $this->getStartDate() . ". End Date: " . $this->getEndDate() . ". Uid: " . $this->getUID() . "<br>";
        return $string;
    }

}