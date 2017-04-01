<?php namespace Modules\Sitemap\Entities\Helpers;


class SitemapFrequency
{
    const ALWAYS = 'always';
    const HOURLY = 'hourly';
    const DAILY = 'daily';
    const WEEKLY = 'weekly';
    const MONTHLY = 'monthly';
    const YEARLY = 'yearly';
    const NEVER = 'never';

    private $frequencies;

    public function __construct()
    {
        $this->frequencies = [
            self::ALWAYS => trans('core::sitemap.form.frequency.always'),
            self::HOURLY => trans('core::sitemap.form.frequency.hourly'),
            self::DAILY  => trans('core::sitemap.form.frequency.daily'),
            self::WEEKLY => trans('core::sitemap.form.frequency.weekly'),
            self::MONTHLY => trans('core::sitemap.form.frequency.monthly'),
            self::YEARLY => trans('core::sitemap.form.frequency.yearly'),
            self::NEVER  => trans('core::sitemap.form.frequency.never'),
        ];
    }

    public function lists()
    {
        return $this->frequencies;
    }

    public function get($frequency)
    {
        if (isset($this->frequencies[$frequency])) {
            return $this->frequencies[$frequency];
        }
        return $this->frequencies[self::WEEKLY];
    }
}