<?php
class Plans
{
    protected $main;
    protected $timeEveryDay;
    protected $timeLifeTime;

    public function setMain($main)
    {
        $this->main = $main;
    }

    public function setTimeEveryDay($timeEveryDay)
    {
        $this->timeEveryDay = $timeEveryDay;
    }

    public function setTimeLifeTime($timeLifeTime)
    {
        $this->timeLifeTime = $timeLifeTime;
    }

    public function getMain()
    {
        return $this->main;
    }

    public function getTimeEveryDay()
    {
        return $this->timeEveryDay;
    }

    public function getTimeLifeTime()
    {
        return $this->timeLifeTime;
    }

    public function setDailyWork($pdo, $insertMain = array())
    {

    }
}

include $_SERVER['DOCUMENT_ROOT'] . '/php/views/plans.html.php';