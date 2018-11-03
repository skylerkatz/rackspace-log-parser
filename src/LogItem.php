<?php

namespace SkylerKatz\RackspaceLogParser;

class LogItem
{
    /**
     * The raw log item
     *
     * @var string
     */
    public $raw;

    /**
     * Client IP Address
     *
     * @var string
     */
    public $clientIp;

    /**
     * The date the file was accessed
     *
     * @var Carbon\Carbon
     */
    public $accessDate;

    /**
     * HTTP Method used to access the file
     *
     * @var string
     */
    public $method;

    /**
     * The file that was requested
     *
     * @var string
     */
    public $request;

    /**
     * The version of HTTP used to make the request
     *
     * @var string
     */
    public $httpVersion;

    /**
     * The status code that was returned for the file
     *
     * @var int
     */
    public $returnCode;

    /**
     * How many bytes were returned for the file
     *
     * @var int
     */
    public $bytesSent;

    /**
     * The referring URL
     *
     * @var string|null
     */
    public $referrer;

    /**
     * The user agent string
     *
     * @var string
     */
    public $userAgent;
}
