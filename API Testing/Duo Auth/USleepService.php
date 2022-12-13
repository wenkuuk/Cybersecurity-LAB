<?php
interface SleepService
{
    public function sleep($seconds);
}
class USleepService implements SleepService
{
    public function sleep($seconds)
    {
        usleep($seconds * 1000000);
    }
}