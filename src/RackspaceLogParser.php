<?php

namespace SkylerKatz\RackspaceLogParser;

class RackspaceLogParser
{
    /**
     * Rexeg Pattern to match Rackspace Cloud Files Logs.
     */
    const PATTERN = '/^([^ ]+) ([^ ]+) ([^ ]+) (\[[^\]]+\]) "(.*) (.*) (.*)" ([0-9\-]+) ([0-9\-]+) "(.*)" "(.*)/m';

    /**
     * Max Buffer size for reading log file.
     */
    const BUFFER_SIZE = 4096;

    /**
     * The path to the log file.
     *
     * @var string
     */
    protected $path;

    /**
     * The log file in memory.
     *
     * @var string
     */
    protected $log;

    /**
     * Create a new RackspaceLogParser Instance.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->processLog();
    }

    /**
     * Parse a log file into an arrray of LogItems.
     *
     * @return array
     */
    public function parse()
    {
        $entries = [];

        foreach ($this->getLogRows() as $row) {
            $entry = $this->parseRow($row);
            $entries[] = $this->createLogItem($entry);
        }

        return $entries;
    }

    /**
     * read a log file into memory.
     *
     * @return void
     */
    private function processLog()
    {
        // Open our file in binary mode
        $file = gzopen($this->path, 'rb');

        // Keep repeating until the end of the input file
        $log = '';
        while (!gzeof($file)) {
            $log .= gzread($file, self::BUFFER_SIZE);
        }

        // File is done, close files
        gzclose($file);

        $this->log = $log;

        return $this;
    }

    /**
     * Get the rows of a log.
     *
     * @return array
     */
    private function getLogRows()
    {
        return array_filter(explode(PHP_EOL, $this->log));
    }

    /**
     * Parse a row into its component parts.
     *
     * @param string $row
     *
     * @return array
     */
    private function parseRow($row)
    {
        preg_match(self::PATTERN, $row, $entry);

        return $entry;
    }

    /**
     * Create a Log Item from a parsed log row.
     *
     * @param array $entry
     *
     * @return LogItem
     */
    private function createLogItem($entry)
    {
        $logItem = new LogItem();
        $logItem->raw = $entry[0];
        $logItem->clientIp = $entry[1];
        $logItem->accessDate = $this->parseDate($entry[4]);
        $logItem->method = $entry[5];
        $logItem->request = $entry[6];
        $logItem->httpVersion = $entry[7];
        $logItem->returnCode = intval($entry[8]);
        $logItem->bytesSent = intval($entry[9]);

        $logItem->referrer = $entry[10] == '-' ? null : $entry[10];
        $logItem->userAgent = $entry[11];

        return $logItem;
    }

    /**
     * Parse a log date.
     *
     * @param string $date
     *
     * @return \Carbon\Carbon
     */
    private function parseDate($date)
    {
        $accessDate = str_replace('[', '', $date);
        $accessDate = str_replace(']', '', $accessDate);
        $accessDate = explode(' ', $accessDate);

        return \Carbon\Carbon::createFromFormat('d/m/Y:H:i:s', $accessDate[0], new \DateTimeZone('UTC'));
    }
}
