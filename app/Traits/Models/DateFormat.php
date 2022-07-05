<?php

namespace App\Traits\Models;

use DateTimeInterface;

trait DateFormat
{

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  \DateTimeInterface  $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return get_current_date_time($date);
    }

    /**
     * Created at format
     * You can serialize created date only
     */
    public function getCreatedAtAttribute($date)
    {
        return $date ??  "";
    }

    /**
     * Updated at format
     * You can serialize updated date only
     */
    public function getUpdatedAtAttribute($date)
    {
        return $date ??  "";
    }

    /**
     * Deleted at format
     * You can serialize deleted date only
     */
    public function getDeletedAtAttribute($date)
    {
        return $date ??  null;
    }
}
