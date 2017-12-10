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
     * @param void
     * @return array result of count
     * counting function
     */
    public function go():array;
    /*
     * @param array $points
     * @return bool
     * set points of way
     */ 
    public function setPoints(array $points):bool;
}
