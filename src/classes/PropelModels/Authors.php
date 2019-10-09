<?php

namespace PropelModels;

use PropelModels\Base\Authors as BaseAuthors;

/**
 * Skeleton subclass for representing a row from the 'authors' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Authors extends BaseAuthors
{
    /**
     * @name getFullname
     *
     * @author G.Maccario <g_maccario@hotmail.com>
     * @return
     */
    public function getFullname()
    {
        return $this->getFirstname() . ' ' . $this->getLastname();
    }
}
