<?php

/*
 *
 */

/**
 * Description of TravellInterface
 *
 * @author mv28jam
 */
interface TravellInterface {
    /*
     * 
     */
    public function init();
    //
    public function go():array;
    // 
    public function setPoints(array $points):bool;
}
